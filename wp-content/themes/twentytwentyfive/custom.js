document.addEventListener("DOMContentLoaded", function() {
  const title = document.querySelector(".wp-block-query-title");
  if (title) {
    // Find text inside quotes and wrap it
    title.innerHTML = title.innerHTML.replace(/“([^”]+)”/, '“<span class="highlight">$1</span>”');
  }
});
