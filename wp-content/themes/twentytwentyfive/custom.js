

document.addEventListener("DOMContentLoaded", function() {
  const title = document.querySelector(".search-result-custom");
  
  if (title) {
    // 1. Get the current text of the title element.
    const currentText = title.innerHTML;

    // 2. Use a regular expression to find the text inside the smart quotes.
    // The capture group ($1) holds the "Search keyword" part.
    const match = currentText.match(/“([^”]+)”/);

    if (match && match[1]) {
      const searchTerm = match[1];
      
      // 3. Construct the new HTML: "Search: " plus the quoted term,
      //    wrapping the quoted term and quotes in the highlight span.
      title.innerHTML = `Search: <span class="highlight">“${searchTerm}”</span>`;
    } 
    // If no quotes are found, it leaves the title as it is.
  }
});