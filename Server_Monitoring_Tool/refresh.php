<!DOCTYPE html>
<html>
<style>
.test {
  background-color: yellow;
}
</style>

<body style="font-size:20px;height:1500px">

<h1>The onscroll Event</h1>

<p id="myP" style="position:fixed">
If you scroll 50 pixels down from the top of this page, the class "test" is added to this paragraph.
Scroll up again to remove the class.</p>

<script>
    var a;
window.onscroll = function() {myFunction()};

function myFunction() {
  if (document.documentElement.scrollTop < 200) {
    
        
      console.log("hello");
      }
       
  } 

</script>

</body>
</html>

