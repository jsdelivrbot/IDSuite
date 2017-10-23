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
            enableGridView: true,
            secondParentIdField: "secondParentId",
            enableEdit: false,
            primaryFields: ["Name", "Title", "Phone", "Mail"],
            photoFields: ["image"],

//            renderNodeEvent: renderNodHandler,
            dataSource: [
                { id: 1, parentId: null, Name: "Tracy Mills", Title: "President", Phone: "678-772-470", Mail: "tmills@e-idsolutions.com", Address: "Atlanta, GA 30303", image: "/img/images/f-11.jpg" },
                { id: 2, parentId: 1, Name: "John Hess", Title: "VP Operations" , Phone: "937-912-4971", Mail: "anderson@jourrapide.com", image: "/img/images/f-10.jpg" },
                { id: 3, parentId: 1, Name: "Tim Moran", Title: "Controller", Phone: "314-722-6164", Mail: "thornton@armyspy.com", image: "/img/images/f-9.jpg" },
                { id: 4, parentId: 1, Name: "Brad Ballentine", Title: "VP Cust Svc Prod Dev/Mgmt", Phone: "330-263-6439", Mail: "shetler@rhyta.com", image: "/img/images/f-5.jpg" },
                { id: 5, parentId: 1, Name: "Chris Apple", Title: "Director, Engineering", Phone: "408-460-0589", image: "/img/images/f-4.jpg" },
                { id: 6, parentId: 1, Name: "Zac Cook", Title: "VP Enterprise Sales ", Phone: "801-920-9842", Mail: "JasonWGoodman@armyspy.com", image: "/img/images/f-8.jpg" },
                { id: 7, parentId: 1, Name: "Rick Dawson", Title: "VP Healthcare Sales", Phone: "Conservation scientist", Mail: "hodges@teleworm.us", image: "/img/images/f-7.jpg" },
                { id: 8, parentId: 4, Name: "Nicholas Luthy", Title: "Dir, Product Mangement", Phone: "989-474-8325", Mail: "hunter@teleworm.us", image: "/img/images/f-6.jpg" },
                { id: 9, parentId: 8, Name: "Alex MacDonald-Smith", Title: "Software Engineer", Phone: "479-359-2159", image: "/img/images/f-3.jpg" },
                { id: 10, parentId: 8, secondParentId: 4, Name: "Alex Lindsay", Title: "Software Engineer Intern", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 11, parentId: 8, Name: "Fawzi Briedi", Title: "Software Engineer", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 12, parentId: 2, Name: "Anthony Kaufman", Title: "Project Manager, Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 13, parentId: 2, Name: "Leah Cooper", Title: "Procurement Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 14, parentId: 12, Name: "Josh Hart", Title: "Project Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 15, parentId: 12, Name: "Katherine Ivanov", Title: "Project Coordinator", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 16, parentId: 5, Name: "Mike Jezierski", Title: "IT Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 17, parentId: 5, Name: "Jason Ward", Title: "IT Contractor - American Structure Point", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 18, parentId: 5, Name: "Robbie Kibler", Title: "IT Contractor - American Structure Point", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 19, parentId: 7, Name: "Marlow King", Title: "Regional Sales Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 20, parentId: 7, Name: "Steve Benoy", Title: "Regional Sales Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 21, parentId: 7, Name: "Stephanie Mathes", Title: "Account Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 22, parentId: 7, Name: "Deibra Burns", Title: "Dir, Partner Devlopment", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 23, parentId: 7, Name: "Patrick Doran", Title: "Sr. Account Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 24, parentId: 19, Name: "Alli Sink", Title: "Account Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 25, parentId: 23, Name: "Kara Kaufman", Title: "Account Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 26, parentId: 23, Name: "Caleb Dawson", Title: "Sales Intern", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 27, parentId: 3, Name: "Amy Wilson", Title: "AR Manager", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 28, parentId: 3, Name: "Sharon Chrisman", Title: "AP Specialist", Phone: "847-474-8775", image: "/img/images/f-2.jpg" },
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