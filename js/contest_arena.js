var LastCode = encodeURIComponent($("#code_area").val());
var LastSubmittedCode = "";

$("#run_code").click(function(){
  $("#run_code").prop("disabled",true);
  $("#output_loader").addClass("d-inline");
  $("#output_loader").removeClass("d-none");
  let code = encodeURIComponent($("#code_area").val());
  if(code === ""){
    alert("Please Enter Code");
    $("#run_code").prop("disabled",false);
    $("#output_loader").removeClass("d-inline");
    $("#output_loader").addClass("d-none");
    return;
  }

  let input = encodeURIComponent($("#input").val());
  let language = encodeURIComponent($("#language").val());
  let formdata = "code="+code+"&input="+input+"&language="+language+"&questionlevel_number="+questionlevel_number+"&user_id="+user_id;
  let request = $.ajax({
    url:"compile.php",
    type:"POST",
    data:formdata
  });

  request.done(function(msg){
    $("#run_code").prop("disabled",false);
    $("#output_loader").removeClass("d-inline");
    $("#output_loader").addClass("d-none");
    $("#output").val(msg);
  });

  request.fail(function(o,textStatus){
    $("#run_code").prop("disabled",false);
    $("#output_loader").removeClass("d-inline");
    $("#output_loader").addClass("d-none");
    alert("Request Failed: "+textStatus);
  });
});

$("#submit_code").click(function(){
  $("#submit_output").addClass("d-none");
  $("#submit_code").prop("disabled",true);
  $(".submit_loader").removeClass("d-none");
  let code = encodeURIComponent($("#code_area").val());
  if(code === ""){
    alert("Please Enter Code");
    $("#submit_code").prop("disabled",false);
    $(".submit_loader").addClass("d-none");
    return;
  }
  if(code == LastSubmittedCode){
    alert('You cannot submit the same code again!!');
    $("#submit_code").prop("disabled",false);
    $("#submit_output").removeClass("d-none");
    $(".submit_loader").addClass("d-none");
    return;
  }
  LastSubmittedCode = code;
  let language = encodeURIComponent($("#language").val());
  let formdata = "code="+code+"&language="+language+"&questionlevel_number="+questionlevel_number+"&user_id="+user_id;
  let request = $.ajax({
    url:"submitCode.php",
    type:"POST",
    data:formdata
  });

  request.done(function(msg){
    $("#submit_code").prop("disabled",false);
    $("#submit_output").removeClass("d-none");
    $(".submit_loader").addClass("d-none");
    if(msg == "success"){
      $("#submit_output").removeClass("alert-danger");
      $("#submit_output").addClass("alert-success");
      $("#submit_output").html("<strong>Success</strong> : All pretestcase passed");
    } else {
      $("#submit_output").removeClass("alert-success");
      $("#submit_output").addClass("alert-danger");
      $("#submit_output").html(msg);
    }
  });

  request.fail(function(o,textStatus){
    $("#submit_code").prop("disabled",false);
    $("#submit_loader").addClass("d-none");
    alert("Request Failed: "+textStatus);
  });
});

function save(){
  let code = encodeURIComponent($("#code_area").val());
  let language = encodeURIComponent($("#language").val());
  if(code == LastCode || code == ""){
    return;
  }

  LastCode = code;
  let formdata = "code="+code+"&language="+language+"&questionlevel_number="+questionlevel_number+"&user_id="+user_id;
  let request = $.ajax({
    url:"saveCode.php",
    type:"POST",
    data:formdata
  });

  request.done(function(msg){
    //console.log(msg);
  });

  request.fail(function(o,textStatus){
    console.log("Failed to autosave");
  });
}

setInterval(function(){
  save();
},5000);

let interval = ending_time - current_time;

setInterval(function () {
  interval--;
  let h = Math.floor(interval / 3600);
  let m = Math.floor((interval%3600)/60);
  let s = Math.floor((interval%60));
  if(h<=0 && m<=0 && s<=0){
    window.location.href = "quitcontest.php?timeup=true";
  }
  if(h<10){
    h = "0"+h;
  }
  if(m<10){
    m = "0"+m;
  }
  if(s<10){
    s = "0"+s;
  }
  $(".timer").text("Remaining : "+h+":"+m+":"+s)
}, 1000);

if($('#language').val() == "java"){
  $('.language_suggestion').text("Class name should be \"test\" (whitout quotes) with no access specifier eg:- class test ");
}

$('#language').on('change',function(){
  if($('#language').val() == "java"){
    $('.language_suggestion').text("Class name should be \"test\" (whitout quotes) with no access specifier eg:- class test ");
  } else {
    $('.language_suggestion').text("");
  }
});

$("#question1").click(function(){
  window.location.href = "contest_arena.php?question=1";
});
$("#question2").click(function(){
  window.location.href = "contest_arena.php?question=2";
});
$("#question3").click(function(){
  window.location.href = "contest_arena.php?question=3";
});
$(".confirmQuit").click(function(){
  window.location.href = "quitcontest.php";
});
