@extends('layouts.medsitter')

@section('content')

    <div class="row mt-2">

        <div class="col-lg-11" style="margin-left: 3.75%;">
            <div class="card" style="background-color: #434857 !important">

                <div class="card-block text-white">


                    <h1 class="card-title">Create Pods</h1>


                    <form id="pod-form mt-5">
                        <div class="form-group">
                            <label for="pod-name">Room Name</label>
                            <input class="form-control" id="pod-name" placeholder="Pod Name..." minlength="2" type="text" required/>
                        </div>

                        <a id="pod-submit" class="btn btn-nav-orange" style="cursor: pointer !important;"><i class="fa fa-plus"></i> &nbsp; Create Room</a>

                    </form>



                </div>

            </div>
        </div>

    </div>




@endsection


@push('medsitter_library')

    <script type="text/javascript">

        $('#pod-submit').click(function(){

            let name = $('#pod-name').val();

            $.ajax({
                type: "POST",
                url: 'pod',
                data: {
                    name: name
                },
                success: function (data) {

                    alert("Pod "+ data.pod.name+" Create");

                }
            });

        });

    </script>

@endpush