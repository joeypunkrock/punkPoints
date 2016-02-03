<p style="color:#646464;font-size:14px;">Sponsored by <b>Buckfast</b>. Brewed by Monks, drunk by <b>Punks</b>!</p>
<a id="vidOpen"><img class="gg" src="img/tyrone.png"></a>
</div> <!--/contentHolder-->

</body>
</html>

<script>
  $("#vidClose").mouseup(function() {
    $(".vidHolder").hide();
    $('#tyroneVid').get(0).pause()
  });
  $("#vidOpen").mouseup(function() {
    $(".vidHolder").show();
    $('#tyroneVid').get(0).play()
    setTimeout(
      function() 
      {
        $(".vidHolder").hide();
      }, 5800);
  });
</script>
