$(document).ready(function() {

  $('#loader_province').css("visibility", "hidden");
  $('#loader_district').css("visibility", "hidden");
  $('#loader_sector').css("visibility", "hidden");
  $('#loader_cell').css("visibility", "hidden");

  $('select[name="province_id"]').on('change', function() {

    var provinceId = $(this).val();

    if(provinceId) {

      // alert(provinceId);

      $.ajax({

        url: '/admin/districts/get/' + provinceId,
        type: "GET",
        dataType: "json",
        beforeSend: function() {

          $('#loader_province').css("visibility", "visible");
        },
        success: function(data) {

          $('select[name="district_id"]').empty();

          $('select[name="district_id"]').append('<option value="">Choose district</option>');

          $.each(data, function(key, value) {

            $('select[name="district_id"]').append('<option value="' + key + '">' + value + '</option>');

          });

        },
        complete: function() {

          $('#loader_province').css("visibility", "hidden");

        }

      });

    } else {

      $('select[name="district_id"]').empty();
    }

  });

  $('select[name="district_id"]').on('change', function() {

    var districtId = $(this).val();

    if(districtId) {

      // alert(districtId);

      $.ajax({

        url: '/admin/sectors/get/' + districtId,
        type: "GET",
        dataType: "json",
        beforeSend: function() {

          $('#loader_district').css("visibility", "visible");
        },
        success: function(data) {

          $('select[name="sector_id"]').empty();

          $('select[name="sector_id"]').append('<option value="">Choose sector</option>');

          $.each(data, function(key, value) {

            $('select[name="sector_id"]').append('<option value="' + key + '">' + value + '</option>');

          });

        },
        complete: function() {

          $('#loader_district').css("visibility", "hidden");

        }

      });

    } else {

      $('select[name="sector_id"]').empty();
    }

  });

  $('select[name="sector_id"]').on('change', function() {

    var sectorId = $(this).val();

    if(sectorId) {

      // alert(sectorId);

      $.ajax({

        url: '/admin/cells/get/' + sectorId,
        type: "GET",
        dataType: "json",
        beforeSend: function() {

          $('#loader_sector').css("visibility", "visible");
        },
        success: function(data) {

          $('select[name="cell_id"]').empty();

          $('select[name="cell_id"]').append('<option value="">Choose cell</option>');

          $.each(data, function(key, value) {

            $('select[name="cell_id"]').append('<option value="' + key + '">' + value + '</option>');

          });

        },
        complete: function() {

          $('#loader_sector').css("visibility", "hidden");

        }

      });

    } else {

      $('select[name="cell_id"]').empty();
    }

  });

  $('select[name="cell_id"]').on('change', function() {

    var cellId = $(this).val();

    if(cellId) {

      // alert(cellId);

      $.ajax({

        url: '/admin/villages/get/' + cellId,
        type: "GET",
        dataType: "json",
        beforeSend: function() {

          $('#loader_cell').css("visibility", "visible");
        },
        success: function(data) {

          $('select[name="village_id"]').empty();

          $.each(data, function(key, value) {

            $('select[name="village_id"]').append('<option value="' + key + '">' + value + '</option>');

          });

        },
        complete: function() {

          $('#loader_cell').css("visibility", "hidden");

        }

      });

    } else {

      $('select[name="village_id"]').empty();
    }

  });  

});