
<!DOCTYPE html>
<html>
<body>

<form>
  <p>
    <label>Special Rate: </label>
    <input type="text" id="sr" onChange="autoFill(); return false;">
  </p>
  <p>
    <label>Normal Rate: </label>
    <input type="text" id="nr">
  </p>
  <p>
    <label>Period: </label>
    <select id="input2" onChange="autoFill(); return false;">
      <option value="1">1</option>
      <option value="3">3</option>
      <option value="6">6</option>
      <option value="12">12</option>
    </select>
  </p>
  <p>
    <label>Radio Input: </label>
       <input type="radio" name="input3" value="Radio1">First Radio
       <input type="radio" name="input3" value="Radio2">Second Radio
       <input type="radio" name="input3" value="Radio3">Third Radio
  </p>
  <p id="demo"></p>
  <p id="apr"></p>
</form>
    <table border='1'>
    <tr>
        <th>Term</th>
        <th>Counter Rate</th>
        <th>Area Manager</th>
        <th>Regional Head</th>
        <th>Director</th>
    </tr>
    @foreach($data as $datas)
        <tr>
            <td>{{$datas->term}}</td>
            <td>{{$datas->counter_rate}}</td>
            <td>{{$datas->area_manager}}</td>
            <td>{{$datas->regional_head}}</td>
            <td>{{$datas->director}}</td>
        </tr>
    @endforeach
    </table>
    
<script type="text/javascript">
  function autoFill() {
    var specialRate = document.getElementById('sr').value;
    if(specialRate!='' ){    
    var period = document.getElementById('input2').value;
    var radioElements = document.getElementsByName("input3");
    var pausecontent = new Array();
    <?php foreach($data as $datas){ ?>
        pausecontent.push('<?php echo $datas; ?>');
        alert(pausecontent);
    <?php } ?> 
    var data ;
    for(var i = 0; i<pausecontent.length;i++){
            pausecontent[i] = JSON.parse(pausecontent[i]);
           if(period == pausecontent[i].term){
               data = pausecontent[i];
               break;
           }
    }
    //  document.getElementById("demo").innerHTML = data.term;
     document.getElementById("demo").innerHTML = data.term + ", " + data.counter_rate + ", " + data.area_manager + ", " + data.regional_head + ", " + data.director;
    
     if(specialRate >= data.counter_rate && specialRate <= data.area_manager){
        document.getElementById('nr').value = data.counter_rate;
        document.getElementById("apr").innerHTML = 'BRANCH MANAGER';
     }else if(specialRate >= data.area_manager && specialRate <= data.regional_head){
        document.getElementById('nr').value = data.area_manager;
        document.getElementById("apr").innerHTML = 'AREA MANAGER';
     }else if(specialRate >= data.regional_head && specialRate <= data.director){
        document.getElementById('nr').value = data.regional_head;
        document.getElementById("apr").innerHTML = 'REGIONAL HEAD';
     }else if(specialRate > data.director){
         document.getElementById('nr').value = data.director;
        document.getElementById("apr").innerHTML = 'DIRECTOR';
         
     }
    }
  }

</script>

</body>
</html>


   
    