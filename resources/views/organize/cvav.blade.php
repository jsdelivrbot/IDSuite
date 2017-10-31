@extends('layouts.organize')

@section('content')
    <style type="text/css">
        /*html, body {*/
            /*margin: 0px;*/
            /*padding: 0px;*/
            /*width: 100%;*/
            /*height: 120%;*/
            /*overflow: hidden;*/
        /*}*/

        #people {
            width:  101%;
            height: 100%;
        }

    </style>
    {{--<div class="container">--}}
        <div id="people"></div>
    {{--</div>--}}
@endsection

@push('organize_scripts')
    <script>
/*//        getOrgChart.themes.myCustomTheme =*/
/*//            {*/
/*//                size: [270, 400],*/
/*//                toolbarHeight: 46,*/
/*//                textPoints: [*/
/*//                    { x: 130, y: 50, width: 250 },*/
/*//                    { x: 130, y: 90, width: 250 }*/
/*//                ],*/
/*//                textPointsNoImage: [*/
/*//                    { x: 130, y: 50, width: 250 },*/
/*//                    { x: 130, y: 90, width: 250 }*/
/*//                ],*/
/*//                expandCollapseBtnRadius: 20,*/
/*//                defs: '<filter id="f1" x="0" y="0" width="200%" height="200%"><feOffset result="offOut" in="SourceAlpha" dx="5" dy="5" /><feGaussianBlur result="blurOut" in="offOut" stdDeviation="5" /><feBlend in="SourceGraphic" in2="blurOut" mode="normal" /></filter>',*/
/*//                box: '<rect x="0" y="0" height="400" width="270" rx="10" ry="10" class="myCustomTheme-box" filter="url(#f1)"  />',*/
/*//                text: '<text text-anchor="middle" width="[width]" class="get-text get-text-[index]" x="[x]" y="[y]">[text]</text>',*/
/*////                image: '<clipPath id="getMonicaClip"><circle cx="135" cy="255" r="85" /></clipPath><image preserveAspectRatio="xMidYMid slice" clip-path="url(#getMonicaClip)" xlink:href="[href]" x="50" y="150" height="190" width="170"/>',*/
/*//                reporters: '<circle cx="80" cy="190" r="20" class="reporters"></circle><text class="reporters-text" text-anchor="middle" width="100" x="80" y="195">[reporters]</text>'*/
/*//*/
/*//                //ddddd: '<text x="0" y="0">1</text>'*/
/*//            };*/



        var peopleElement = document.getElementById("people");
        var orgChart = new getOrgChart(peopleElement, {
            theme: "vivian",
            color: "darkred",
            enableGridView: false, //Enables spreed sheet type viewing of the chart
            secondParentIdField: "secondParentId", //Adds ability to have two parents, connects to second parent with dashed line
            enableEdit: false, //Allows users to add/delete people
            layout: getOrgChart.MIXED_HIERARCHY_RIGHT_LINKS,
            primaryFields: ["Name", "Title", "Phone", "Mail"],
            photoFields: ["image"],

//            renderNodeEvent: renderNodHandler,
            dataSource: [
                { id: 1, parentId: null, Name: "Tracy Mills", Title: "President", Phone: "678-772-470", Mail: "tmills@e-idsolutions.com", Address: "Atlanta, GA 30303", image: "/img/images/f-11.jpg" },
                { id: 2, parentId: 1, Name: "Chris Platt", Title: "Dir, ClearVisionAV" , Phone: "937-912-4971", Mail: "anderson@jourrapide.com", image: "/img/images/f-10.jpg" },
                { id: 3, parentId: 2, Name: "Richard Clark", Title: "Dir, Operations, CVAV", Phone: "314-722-6164", Mail: "thornton@armyspy.com", image: "/img/images/f-9.jpg" },
                { id: 4, parentId: 2, Name: "Tim Vinci", Title: "Dir, Business Dev", Phone: "330-263-6439", Mail: "shetler@rhyta.com", image: "/img/images/f-5.jpg" },
                { id: 5, parentId: 2, Name: "Sue Phillips", Title: "Billing Specialist", Phone: "408-460-0589", image: "/img/images/f-4.jpg" },
                { id: 6, parentId: 3, Name: "Angie Moody", Title: "Project Coordinator", Phone: "801-920-9842", Mail: "JasonWGoodman@armyspy.com", image: "/img/images/f-8.jpg" },
                { id: 7, parentId: 3, Name: "Dani Williams", Title: "Project Coordinator", Phone: "Conservation scientist", Mail: "hodges@teleworm.us", image: "/img/images/f-7.jpg" },
                { id: 8, parentId: 3, Name: "Jerry Lehman", Title: "Field Engineer", Phone: "989-474-8325", Mail: "hunter@teleworm.us", image: "/img/images/f-6.jpg" },
                { id: 9, parentId: 3, Name: "Will Keller", Title: "Field Engineer", Phone: "479-359-2159", image: "/img/images/f-3.jpg" },
                { id: 10, parentId: 3, Name: "Dan Starkey", Title: "Field Engineer", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
            ]
        });

//        function renderNodHandler(sender, args) {
//            for (var i = 0; i < args.content.length; i++) {
//                if (args.content[i].indexOf("[reporters]") != -1) {
//                    args.content[i] = args.content[i].replace("[reporters]", args.node.children.length);
//                }
//            }
//        }
    </script>
@endpush