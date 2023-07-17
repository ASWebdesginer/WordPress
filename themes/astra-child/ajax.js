// User not logged in
jQuery.ajax({
  url: custom_ajax.ajaxurl,
  type: "GET",
  dataType: "json",
  data: {
    action: "get_architecture_projects",
  },
  success: function (response) {
    if (response.success) {
      var projects = response.data;
      // Process the retrieved projects
      console.log(projects);
    }
  },
});

// User logged in
jQuery.ajax({
  url: custom_ajax.ajaxurl,
  type: "GET",
  dataType: "json",
  data: {
    action: "get_architecture_projects",
  },
  success: function (response) {
    if (response.success) {
      var projects = response.data;
      // Process the retrieved projects
      console.log(projects);
    }
  },
});
