<script>
$(function() {
    $('form[name="pointsForm"]').submit(function(e) {
        var reason = $('form[name="pointsForm"] input[name="reason"]').val();
        if ( reason == '') {
            e.preventDefault();
            window.alert("Enter a reason, fool!")
        }
    });
});

function notifyUpdate() {
//   // Let's check if the browser supports notifications
//   if (!("Notification" in window)) {
//     alert("This browser does not support desktop notification");
//   }

//   // Let's check whether notification permissions have already been granted
//   else if (Notification.permission === "granted") {
//     // If it's okay let's create a notification
//     var notification = new Notification("Punk Points Added!");
//   }

//   // Otherwise, we need to ask the user for permission
//   else if (Notification.permission !== 'denied') {
//     Notification.requestPermission(function (permission) {
//       // If the user accepts, let's create a notification
//       if (permission === "granted") {
//         var notification = new Notification("Punk Points Added!");
//       }
//     });
//   }
// }
</script>