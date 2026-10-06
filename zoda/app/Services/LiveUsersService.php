<?php

namespace App\Services;

class LiveUsersService
{
    /**
     * Deterministic "live users" number based on current time.
     * Same minute + same seed = same number (across all users).
     */
    public static function current(?int $seed = null): int
    {
        $seed = $seed ?? self::globalSeed();

        // Time bucket: changes every 60 seconds
        $minuteBucket = (int) floor(time() / 60);

        // Time-of-day factor (0.15 → 1.0), peaks around 8 PM
        $hour = (int) date('G');
        $radians = (($hour - 16) / 24) * M_PI * 2;
        $factor = 0.15 + ((cos($radians) + 1) / 2) * 0.85;

        // Base for this minute
        $base = 100000 + (int) ((250000 - 100000) * $factor);

        // Deterministic pseudo-noise from seed + minute
        // Same seed + same minute → same offset for everyone
        $noise = self::hashToRange($seed . '-' . $minuteBucket, -4000, 4000);

        // Second-level micro-drift so it "moves" while page is open
        $secondBucket = (int) floor(time() / 5); // every 5 sec
        $micro = self::hashToRange($seed . '-' . $secondBucket, -80, 120);

        $value = $base + $noise + $micro;

        return max(100000, min(1000000, $value));
    }

    /**
     * Global seed: same for all users (e.g. date-based).
     * Change to per-user if you want each user to see a different number.
     */
    public static function globalSeed(): int
    {
        // Rotates daily — number is consistent within the day
        return (int) date('Ymd');
    }

    /**
     * Per-user seed (optional) — each user sees a slightly different number.
     */
    public static function userSeed(int $userId): int
    {
        return crc32(date('Ymd') . '|user|' . $userId);
    }

    /**
     * Deterministic hash → integer in [min, max].
     */
    private static function hashToRange(string $input, int $min, int $max): int
    {
        $hash = crc32($input);          // 0 to 2^32-1
        $range = $max - $min;
        return $min + ($hash % ($range + 1));
    }
}