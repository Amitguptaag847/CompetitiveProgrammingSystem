var queue = 0;
function increaseQueue(){
  queue++;
}
function isJSON(data){
  try{
    json = $.parseJSON(data);
    return true;
  } catch(e) {
    return false;
  }
}

function judgeParticipantCall(current,max,userData){
  judgeParticipant(current,max,userData);
}

function judgeParticipant(current,max,userData){
  if(current < max){
    $(".submissionData #"+userData[current].id).append('<td><img src="img/jud.gif" height=20></td>');

    let request = $.ajax({
      url:"JudgeSubmissions.php",
      type:"POST",
      data:"user_id="+userData[current].id
    });

    request.done(function(msg){
      if(isJSON(msg)){
        data = $.parseJSON(msg);
        $(".submissionData #"+userData[current].id+" .status1").text(data.status1);
        userData[current].status1 = data.status1;
        $(".submissionData #"+userData[current].id+" .status2").text(data.status2);
        userData[current].status2 = data.status2;
        $(".submissionData #"+userData[current].id+" .status3").text(data.status3);
        userData[current].status3 = data.status3;
        $(".submissionData #"+userData[current].id+" .points").text(data.points);
        userData[current].points = data.points;
      } else {
        alert(msg);
      }
      $(".judge").prop("disabled",false);
      $(".submissionData #"+userData[current].id+" td:last").remove();
      judgeParticipantCall(++current,max,userData);
    });

    request.fail(function(o,textStatus){
      alert("Failed to load Judge Data  "+textStatus);
      $(".judge").prop("disabled",false);
    });
  } else {
    $(".judge").prop("disabled",false);
  }
}

$(".logout").click(function(){
  window.location.href = "logout.php";
});

let userData = [];

$(".loadsubmissions").click(function(){
  $(".submissionData").text("");
  $(".loadsubmissions").prop("disabled",true);
  let request = $.ajax({
    url:"loadSubmissions.php",
    type:"POST",
    data:"loadsubmissions=true"
  });

  request.done(function(msg){
    if(isJSON(msg)){
      userData = $.parseJSON(msg);
      let length = userData.length;
      if(length == 0){
        alert("No Submission");
      }
      for(let i=0;i<length;i++){
        let data = '<tr class="text-center" id="'+userData[i].id+'"><td>'+userData[i].id+'</td><td>'+userData[i].fullname+'</td><td>'+userData[i].phonenumber+'</td><td class="status1">'+userData[i].status1+'</td><td class="status2">'+userData[i].status2+'</td><td class="status3">'+userData[i].status3+'</td><td>'+userData[i].time1+'</td><td>'+userData[i].time2+'</td>';
        data+='<td>'+userData[i].time3+'</td><td class="points">'+userData[i].points+'</td></tr>';
        $(".submissionData").append(data);
      }
    } else {
      alert("Some error in data.. Its not in json format");
    }
    $(".loadsubmissions").prop("disabled",false);
  });

  request.fail(function(o,textStatus){
    alert("Failed to load Submission Data  "+textStatus);
    $(".loadsubmissions").prop("disabled",false);
  });
});

/*$(".judge").click(function(){
  if(userData.length == 0){
    alert("Please Load data");
  } else {
    $(".judge").prop("disabled",true);
    let length = userData.length;
    judgeParticipantCall(0,length,userData);
  }
});*/

$(".judge").click(function(){
  if(userData.length == 0){
    alert("Please Load data");
  } else {
    $(".judge").prop("disabled",true);
    let length = userData.length;

    for(let current = 0;current<length;current++){

      $(".submissionData #"+userData[current].id).append('<td><img src="img/jud.gif" height=20></td>');

      let request = $.ajax({
        url:"JudgeSubmissions.php",
        type:"POST",
        data:"user_id="+userData[current].id+"&index="+current,
      });

      request.done(function(msg){
        if(isJSON(msg)){
          data = $.parseJSON(msg);
          $(".submissionData #"+data.id+" .status1").text(data.status1);
          userData[data.index].status1 = data.status1;
          $(".submissionData #"+data.id+" .status2").text(data.status2);
          userData[data.index].status2 = data.status2;
          $(".submissionData #"+data.id+" .status3").text(data.status3);
          userData[data.index].status3 = data.status3;
          $(".submissionData #"+data.id+" .points").text(data.points);
          userData[data.index].points = data.points;
        } else {
          alert(msg);
        }
        if(data.index == userData.length-1){
          $(".judge").prop("disabled",false);
        }
        $(".submissionData #"+userData[data.index].id+" td:last").remove();
      });

      request.fail(function(o,textStatus){
        alert("Failed to load Judge Data  "+textStatus);
        $(".judge").prop("disabled",false);
      });
    }
  }
});

$(".sort").click(function(){
  if(userData.length == 0){
    alert("Please Load data");
  } else {
    userData.sort(function(a,b){return a.points-b.points});
    $(".submissionData").text("");
    let length = userData.length;
    for(let i=0;i<length;i++){
      let data = '<tr class="text-center"><td>'+userData[i].id+'</td><td>'+userData[i].fullname+'</td><td>'+userData[i].phonenumber+'</td><td>'+userData[i].status1+'</td><td>'+userData[i].status2+'</td><td>'+userData[i].status3+'</td><td>'+userData[i].time1+'</td><td>'+userData[i].time2+'</td>';
      data+='<td>'+userData[i].time3+'</td><td>'+userData[i].points+'</td></tr>';
      $(".submissionData").append(data);
    }
  }
});
