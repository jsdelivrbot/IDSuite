@extends('layouts.app')

@section('content')

    <div class="row mt-5">
        <div class="col-12">
            <section class="text-white">
                <table class="table table-bordered hide text-white" id="medicare-table" style="border-radius: 15px">
                    <thead>
                    <tr>
                        <th style="border: none">Provider ID</th>
                        <th style="border: none">Hospital Name</th>
                        <th style="border: none">Address</th>
                        <th style="border: none">City</th>
                        <th style="border: none">State</th>
                        <th style="border: none">ZIP Code</th>
                        <th style="border: none">County Name</th>
                        <th style="border: none">Phone Number</th>
                        <th style="border: none">Hospital Type</th>
                        <th style="border: none">Hospital Ownership</th>
                        <th style="border: none">Emergency Services</th>
                        <th style="border: none">Meets criteria for meaningful use of EHRs</th>
                        <th style="border: none">Hospital overall rating</th>
                        <th style="border: none">Mortality national comparison</th>
                        <th style="border: none">Safety of care national comparison</th>
                        <th style="border: none">Readmission national comparison</th>
                        <th style="border: none">Patient experience national comparison</th>
                        <th style="border: none">Effectiveness of care national comparison</th>
                        <th style="border: none">Timeliness of care national comparison</th>
                        <th style="border: none">Efficient use of medical imaging national comparison</th>
                        <th style="border: none">Location</th>
                    </tr>
                    </thead>
                </table>
            </section>
        </div>
    </div>


@endsection

@push('trust')


    <script>

        $(document).ready(function() {
            $('#medicare-table').dataTable( {
                ajax:
                    {
                        url: "https://data.medicare.gov/resource/rbry-mqwu.json?$limit=5000",
                        dataSrc: ""
                    },
                aoColumns: [
                    { "mData": "provider_id" },
                    { "mData": "hospital_name" },
                    { "mData": "address" },
                    { "mData": "city" },
                    { "mData": "state" },
                    { "mData": "zip_code" },
                    {
                        "mData": "county_name",
                        "mRender": function(data){
                            if(typeof data !== 'undefined') {
                                return data
                            } else {
                                return "Unknown";
                            }
                        }
                    },
                    { "mData": "phone_number" },
                    { "mData": "hospital_type" },
                    { "mData": "hospital_ownership" },
                    { "mData": "emergency_services" },
                    {
                        "mData": "meets_criteria_for_meaningful_use_of_ehrs",
                        "mRender": function(data){
                            if(typeof data !== 'undefined') {
                                return data
                            } else {
                                return "Unknown";
                            }

                        }
                    },
                    { "mData": "hospital_overall_rating" },
                    { "mData": "mortality_national_comparison" },
                    { "mData": "safety_of_care_national_comparison" },
                    { "mData": "readmission_national_comparison" },
                    { "mData": "patient_experience_national_comparison" },
                    { "mData": "effectiveness_of_care_national_comparison" },
                    { "mData": "timeliness_of_care_national_comparison" },
                    { "mData": "efficient_use_of_medical_imaging_national_comparison" },
                    {
                        "mData": "location",
                        "mRender": function(data){
                            if(typeof data !== 'undefined') {

                                return "Lat: " + data.coordinates[0] + " Lng: " + data.coordinates[1];
                            } else {
                                return "Unknown";
                            }

                        }
                    },

                ]
            } );
        } );

    </script>


@endpush