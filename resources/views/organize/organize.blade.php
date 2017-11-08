@extends('layouts.organize')

@section('content')
    <div id="people"></div>
@endsection

@push('organize_scripts')
    <script>
        $.ajax({
            type: "GET",
            url: '/api/getUserHierarchy',
            success: function (data) {

                console.log(data);

                var peopleElement = document.getElementById("people");
                var orgChart = new getOrgChart(peopleElement, {
                    theme: "vivian",
                    color: "darkred",
                    enableGridView: false,
                    enableEdit: false,
                    primaryFields: ["name", "mail"],
                    renderNodeEvent: renderNodHandler,
                    dataSource: data
                });

                function renderNodHandler(sender, args) {
                    for (var i = 0; i < args.content.length; i++) {
                        if (args.content[i].indexOf("[reporters]") != -1) {
                            args.content[i] = args.content[i].replace("[reporters]", args.node.children.length);
                        }
                    }
                }
            }
        });
    </script>
@endpush