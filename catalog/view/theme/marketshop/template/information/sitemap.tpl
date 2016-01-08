<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
  var myCenter=new google.maps.LatLng(-6.891401, 107.553423);
  function initialize()
  {
    var mapProp = {
      center:myCenter,
      zoom:15,
      mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    var marker=new google.maps.Marker({
      position:myCenter,
    });
    marker.setMap(map);
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <div class="row">
        <div id="googleMap" style="width:100%; height:450px;"></div>
      </div>
      <?php echo $content_bottom; ?></div>
      <?php echo $column_right; ?></div>
    </div>
    <?php echo $footer; ?>