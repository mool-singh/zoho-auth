$(window).on("load", function () {
    $(".loader-container").fadeOut(0);
  });

function showLoader()
{
  $(".loader-container").show();
}

function hideLoader()
{
  $(".loader-container").fadeOut(1000);
}