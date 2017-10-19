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
            width:  122%;
            height: 100%;
        }
    </style>
    <div class="container">
        <div id="people"></div>
    </div>
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
//            primaryFields: ["Name", "Job Title"],
            primaryFields: ["name", "title", "phone", "mail"],
            photoFields: ["image"],
//            dataSource:"mrge-list.xml"
//            renderNodeEvent: renderNodHandler,
            dataSource: [
                { id: 1, parentId: null, name: "Tracy Mills", title: "President", phone: "678-772-470", mail: "tmills@e-idsolutions.com", adress: "Atlanta, GA 30303", image: "/img/images/f-11.jpg" },
                { id: 2, parentId: 1, name: "John Hess", title: "VP Operations" , phone: "937-912-4971", mail: "anderson@jourrapide.com", image: "/img/images/f-10.jpg" },
                { id: 3, parentId: 1, name: "Tim Moran", title: "Controller", phone: "314-722-6164", mail: "thornton@armyspy.com", image: "/img/images/f-9.jpg" },
                { id: 4, parentId: 1, name: "Brad Ballentine", title: "VP Cust Svc Prod Dev/Mgmt", phone: "330-263-6439", mail: "shetler@rhyta.com", image: "/img/images/f-5.jpg" },
                { id: 5, parentId: 1, name: "Chris Apple", title: "Director, Engineering", phone: "408-460-0589", image: "/img/images/f-4.jpg" },
                { id: 6, parentId: 1, name: "Zac Cook", title: "VP Enterprise Sales ", phone: "801-920-9842", mail: "JasonWGoodman@armyspy.com", image: "/img/images/f-8.jpg" },
                { id: 7, parentId: 1, name: "Rick Dawson", title: "VP Healthcare Sales", phone: "Conservation scientist", mail: "hodges@teleworm.us", image: "/img/images/f-7.jpg" },
                { id: 8, parentId: 4, name: "Nicholas Luthy", title: "Dir, Product Mangement", phone: "989-474-8325", mail: "hunter@teleworm.us", image: "/img/images/f-6.jpg" },
                { id: 9, parentId: 8, name: "Alex MacDonald-Smith", title: "Software Engineer", phone: "479-359-2159", image: "/img/images/f-3.jpg" },
                { id: 10, parentId: 8, secondParentId: 4, name: "Alex Lindsay", title: "Software Engineer Intern", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 11, parentId: 8, name: "Fawzi Briedi", title: "Software Engineer", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 12, parentId: 2, name: "Anthony Kaufman", title: "Project Manager, Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 13, parentId: 2, name: "Leah Cooper", title: "Procurement Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 14, parentId: 12, name: "Josh Hart", title: "Project Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 15, parentId: 12, name: "Katherine Ivanov", title: "Project Coordinator", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 16, parentId: 5, name: "Mike Jezierski", title: "IT Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 17, parentId: 5, name: "Jason Ward", title: "IT Contractor - American Structure Point", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 18, parentId: 5, name: "Robbie Kibler", title: "IT Contractor - American Structure Point", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 19, parentId: 7, name: "Marlow King", title: "Regional Sales Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 20, parentId: 7, name: "Steve Benoy", title: "Regional Sales Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 21, parentId: 7, name: "Stephanie Mathes", title: "Account Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 22, parentId: 7, name: "Deibra Burns", title: "Dir, Partner Devlopment", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 23, parentId: 7, name: "Patrick Doran", title: "Sr. Account Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 24, parentId: 19, name: "Alli Sink", title: "Account Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 25, parentId: 23, name: "Kara Kaufman", title: "Account Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 26, parentId: 23, name: "Caleb Dawson", title: "Sales Intern", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 27, parentId: 3, name: "Amy Wilson", title: "AR Manager", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
                { id: 28, parentId: 3, name: "Sharon Chrisman", title: "AP Specialist", phone: "847-474-8775", image: "/img/images/f-2.jpg" },
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