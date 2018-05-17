<a href="#" onClick="autoFill(); return false;" >Click to Autofill</a>
<form>
  <p>
    <label>Special Rate: </label>
    <input type="text" id="sr">
  </p>
  <p>
    <label>Normal Rate: </label>
    <input type="text" id="nr">
  </p>
  <p>
    <label>Period: </label>
    <select id="input2">
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
    var period = document.getElementById('input2').value;
 
    var radioElements = document.getElementsByName("input3");

    for (var i=0; i<radioElements.length; i++) {
      if (radioElements[i].getAttribute('value') == 'Radio3') {
        radioElements[i].checked = true;
      }
    }

    
    // alert(specialRate);
    if(period = 1){
        
        alert('yeay');
    }
    if (specialRate < 50 ) {
        alert('Bad');
        alert($timejs);
    } else {
        alert('Good');
    }
  }
</script>