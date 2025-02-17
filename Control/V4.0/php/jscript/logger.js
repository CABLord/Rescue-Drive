// URL of the REST API
const apiUrl = 'http://192.168.237.53:4000/data';

// Fetch data from the REST API
async function fetchData() {
    try {
        console.log("t1");
        const response = await fetch(apiUrl); // Fetch data from the server
        const data = await response.json(); // Parse the JSON response
        displayMessages(data.message); // Display the messages
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

// Display the messages in the logger
function displayMessages(messages) {
    const logger = document.getElementById('logger');
    // Clear existing log entries before adding new ones (optional)
    logger.innerHTML = '';
    messages.forEach((message) => {
        const logEntry = document.createElement('div');
        logEntry.className = `log-entry ${message.type}`; // Add class for outgoing/incoming
        logEntry.textContent = message.text;
        logger.appendChild(logEntry);
    });
}

// Fetch and display the data every 0.5 seconds (500 ms)
setInterval(fetchData, 500);

// Fetch initial data immediately
fetchData();