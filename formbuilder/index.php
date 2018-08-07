<!doctype html>
<html>
<head>
  <title>Form Builder</title>
  <meta name="description" content="">
  <link rel="stylesheet" href="vendor/css/vendor.css" />
  <link rel="stylesheet" href="dist/formbuilder.css" />
  <style>
  * {
    box-sizing: border-box;
  }
  body {
    background-color: #444;
    font-family: sans-serif;
  }
  .fb-main {
    background-color: #fff;
    border-radius: 5px;
    min-height: 600px;
  }
  input[type=text] {
    height: 26px;
    margin-bottom: 3px;
  }
  select {
    margin-bottom: 5px;
    font-size: 40px;
  }
  </style>
</head>
<body>
  <div id="status"></div>
  <div class='fb-main'></div>

  <script src="vendor/js/vendor.js"></script>
  <script src="dist/formbuilder.js"></script>

  <script>
    $(function(){
      fb = new Formbuilder({
        selector: '.fb-main',
        bootstrapData: [
          {
            "label": "Do you have a website?",
            "field_type": "website",
            "required": false,
            "field_options": {},
            "cid": "c1"
          },
          {
            "label": "Please enter your clearance number",
            "field_type": "text",
            "required": true,
            "field_options": {},
            "cid": "c6"
          },
          {
            "label": "Security personnel #82?",
            "field_type": "radio",
            "required": true,
            "field_options": {
                "options": [{
                    "label": "Yes",
                    "checked": false
                }, {
                    "label": "No",
                    "checked": false
                }],
                "include_other_option": true
            },
            "cid": "c10"
          },
          {
            "label": "Medical history",
            "field_type": "file",
            "required": true,
            "field_options": {},
            "cid": "c14"
          }
        ]
      });
      
      fb.on('save', function(payload){
        console.log(payload);
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
        xmlhttp.open("POST","saveJSON.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var return_data = xmlhttp.responseText;
        document.getElementById("status").innerHTML = return_data;
    }
}
        xmlhttp.send("content="+payload+"&formid=1");
      // window.location.href = "saveJSON.php?content="+payload;
    })
    });
  </script>


<?php

/**

     $forms = $db->forms;  //do db staff here get your json value
             var form_inputs = '[<?php echo $forms; ?>]';
             $(function(){
                fb = new Formbuilder({
                  selector: '.fb-main',
                  bootstrapData:  JSON.parse(form_inputs) //your problem is here
                });

                fb.on('save', function(payload){
                  $('#form_input').val('');
                  $('#form_input').val(payload);
                 // console.log(payload);
                })
              });

**/

?>
</body>
</html>