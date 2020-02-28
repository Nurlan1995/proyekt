{{--bu asconun hostudur!--}}
{{--DB_HOST=172.30.2.7--}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portal</title>

    <link type="text/css" rel="stylesheet" href="{{asset('css/skins/material.css')}}?v={{env('APP_VERSION')}}">
    <link type="text/css" media="all" rel="stylesheet"
          href="{{asset('css/materialdesignicons.css')}}?v={{env('APP_VERSION')}}">
    <link type="text/css" media="all" rel="stylesheet" href="{{asset('css/test.css')}}?v={{env('APP_VERSION')}}">
    <link type="text/css" media="all" rel="stylesheet"
          href="{{asset('portal/portalstyle.css')}}?v={{env('APP_VERSION')}}">

    <script type="text/javascript" src="{{asset('libs/webix.js')}}?v={{env('APP_VERSION')}}"></script>
    <script src="{{asset('libs/sidebar.js')}}?v={{env('APP_VERSION')}}" type="text/javascript"></script>
</head>
<body>
<script>
    webix.ui({
        rows: [
            {
                cols: [
                    {
                        view: "button",
                        id: "btn1",
                        value: "Ad günü olanlar",
                        css: "webix_primary",
                        inputWidth: 180,
                        click: function () {
                            webix.ajax().get("getBirthdayPeople", function (txt, res) {
                                if (txt != undefined && txt == 0) {
                                    webix.alert("Bugün Adgünü olan yoxdur");
                                } else {
                                    res = res.json();
                                    $$('dtable').clearAll();
                                    $$('dtable').show();
                                    $$('dtable').parse(res);
                                    $$('btn2').show();
                                }
                            });
                        }
                    },
                    {
                        view: "button",
                        id: "btn2",
                        hidden: true,
                        value: "Təbrik göndər",
                        css: "webix_primary",
                        inputWidth: 150,
                        click: function () {
                            var emails = $$('dtable').serialize();
                            webix.ajax().get("congratulate", {emails: emails}, function (txt) {
                                if (txt != undefined && txt == 1) {
                                    webix.alert("Mesaj göndərildi");
                                }
                            });
                        }
                    },
                    {},
                    {},
                    {},
                    {},
                    {}
                ]
            },
            {
                view: "datatable",
                id: "dtable",
                hidden: true,
                columns: [
                    {id: "emp_name", header: "Ad", width: 200},
                    {id: "emp_surname", header: "Soyad", width: 200},
                    {id: "emp_father_name", header: "Ata adı", width: 200},
                    {id: "emp_email", header: "Email", width: 300},
                    {id: "emp_birthday", header: "Ad günü", width: 200},
                ],
            }
        ]


    })


</script>


</body>
</html>
