import requests
import json
from datetime import datetime
from DATA import DATA
import urllib3

# Suppress only the InsecureRequestWarning because the schhool server uses a self-signed certificate
urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

def send_json(data):
    url = "https://10.10.30.35:5000/api/data"  #School server api url
    urlcompanyserver = "https://resqdrive.ddns.net/server.php" #Company server api url
    headers = {
        "Content-Type": "application/json",
        "x-api-key": "Drive"#API key for the school server
    }
    print("Sende Daten:", data)#Debugging print
    DATA.data.append(data)#append data to the list (Genereal DATA retun)
    
    try:
        response = requests.post(url, json=data, headers=headers, verify=False)#post request to the school server
        if response.status_code == 200:
            try:
                result = response.json()
                return result
            except json.JSONDecodeError:
                return {"status": "error", "message": "Invalid JSON response from server"}
        else:
            return {"status": "error", "message": f"Server returned status code {response.status_code}"}#error on post request
    except requests.exceptions.RequestException as e:
         return {"status": "error", "message": str(e)}



