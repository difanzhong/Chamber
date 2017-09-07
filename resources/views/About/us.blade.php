@extends('Master.layout', ['title'=>'商会介绍', 'nav' => 4])

@section('content')

  <h3 class='title'>关于我们</h3>


  <div class="cont-info">
    <div class="panel">
      <div class="panel-heading">联系方式</div>
      <div class="panel-body">
        <ul class="about-us">
          <li><span class="glyphicon glyphicon-earphone"></span>0000000</li>
          <li><span class="glyphicon glyphicon-envelope"></span>wwwwwww@wwwww.com</li>
          <!-- <li><span class="glyphicon glyphicon-fax"></span>000000</li> -->
        </ul>
      </div>
    </div>
    <div class="panel">
      <div class="panel-heading">微信二维码</div>
      <div class="panel-body">
      </div>
    </div>
    <div class="panel">
      <div class="panel-heading">地点</div>
      <div class="panel-body">
        <div id="map">

        </div>
      </div>
    </div>
  </div>

  <div class="intro panel">
    <div class="panel-heading">商会简介</div>
    <div class="panel-body">
    </div>
  </div>
@endsection

@section('footer')
  <script>
    function myMap() {
    var mapCanvas = document.getElementById("map");
    var mapOptions = {
      center: new google.maps.LatLng(-27.6338098, 153.0450218),
      zoom: 12,
      disableDefaultUI:true,
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);
    }
  </script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBd1ms2dgpHct_chkSJCxpsD3y9wGtLndY&callback=myMap"></script>
@endsection
