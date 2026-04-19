@extends('advertiser.layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
           @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Campaigns 
                        <br><br> 
                    
                    <form action="{{route('store')}}" method="POST">
        @csrf

        <div class="form-group">
        <label for="ad_group_id">Select Ad Group</label>
        <select name="adgroup_id"  class="form-control" required>
            <option value="">Select an Ad Group</option>
            @foreach($adGroups as $adGroup)
                <option value="{{ $adGroup->adgroup_id }}">{{ $adGroup->adgroup_name }} (ID: {{ $adGroup->adgroup_id }})</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="campaign_name">Campaign Name</label>
            <input type="text" class="form-control" id="campaign_name" name="campaign_name" >
        </div>

        <div class="form-group">
            <label for="website_url">Landing Page</label>
            <input type="url" class="form-control" id="landing_page" name="landing_page">
        </div>

         <div class="form-group">
            <label for="website_url">Final URL</label>
            <input type="url" class="form-control" id="final_url" name="final_url" >
        </div>


        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control"  name="end_date" >
        </div>

        <div class="form-group">
            <label for="end_date">Daily Budget ($)</label>
            <input type="number" class="form-control"  name="daily_budget" >
        </div>

        <div class="form-group">
        <label for="ad_group_id">Interest 1</label>
        <select name="interest1"  class="form-control" required>
            
            <option value="" disabled selected>Select Your Interest</option>
                        <option value="all">Target All</option>
                        <option value="Arts">Arts and Entertainment</option>
                        <option value="Business">Business and Finance</option>
                        <option value="Tech">Technology and Science</option>
                        <option value="Health">Health and Wellness</option>
                        <option value="Travel">Travel and Adventure</option>
                        <option value="Sports">Sports and Recreation</option>
                        <option value="Fashion">Fashion and Lifestyle</option>
                        <option value="Food">Food and Drink</option>
                        <option value="Education">Education and Learning</option>
                        <option value="Auto">Automotive and Transportation</option>
                        <option value="Religion">Religion and Spirituality</option>
                        <option value="DIY">DIY and Crafts</option>
        </select>
        </div>

        <div class="form-group">
        <label for="ad_group_id">Interest 2</label>
        <select name="interest2"  class="form-control" >
            
            <option value="" disabled selected>Select Your Interest</option>
                        <option value="all">Target All</option>
                        <option value="Arts">Arts and Entertainment</option>
                        <option value="Business">Business and Finance</option>
                        <option value="Tech">Technology and Science</option>
                        <option value="Health">Health and Wellness</option>
                        <option value="Travel">Travel and Adventure</option>
                        <option value="Sports">Sports and Recreation</option>
                        <option value="Fashion">Fashion and Lifestyle</option>
                        <option value="Food">Food and Drink</option>
                        <option value="Education">Education and Learning</option>
                        <option value="Auto">Automotive and Transportation</option>
                        <option value="Religion">Religion and Spirituality</option>
                        <option value="DIY">DIY and Crafts</option>
        </select>
        </div>

        <div class="form-group">
        <label for="ad_group_id">Interest 3</label>
        <select name="interest3"  class="form-control" >
            
            <option value="" disabled selected>Select Your Interest</option>
                        <option value="all">Target All</option>
                        <option value="Arts">Arts and Entertainment</option>
                        <option value="Business">Business and Finance</option>
                        <option value="Tech">Technology and Science</option>
                        <option value="Health">Health and Wellness</option>
                        <option value="Travel">Travel and Adventure</option>
                        <option value="Sports">Sports and Recreation</option>
                        <option value="Fashion">Fashion and Lifestyle</option>
                        <option value="Food">Food and Drink</option>
                        <option value="Education">Education and Learning</option>
                        <option value="Auto">Automotive and Transportation</option>
                        <option value="Religion">Religion and Spirituality</option>
                        <option value="DIY">DIY and Crafts</option>
        </select>
        </div>

        

        

        <div class="form-group">
            <label for="country">Country</label>
             <select multiple class="form-control select2" id="exampleSelect2" name="country">
             <option value="SA">South Africa</option>
           
    <!-- More options -->
</select>
    <!-- Add more options as needed -->
  </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Campaign</button>
    </form>
                    
                  </div>
                </div>
              </div>
            </div>
            
              
            </div>

            <!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
           
          <!-- content-wrapper ends -->
          @endsection