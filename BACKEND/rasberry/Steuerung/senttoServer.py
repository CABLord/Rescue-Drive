import requests


class Sender():
    TARGET_RESPONSE_URL = ""
    def __init__(self, url):
        self.TARGET_RESPONSE_URL = url


    def normsend(self, message):
        try:
            # Antwortdaten vorbereiten
            response_data = {
                "command": message,
                "status": "processed",
                "source": "Server"  # Zusätzliche Informationen
            }
            headers = {"Content-Type": "application/json"}

            # POST-Anfrage an die Ziel-Website senden
            response = requests.post(self.TARGET_RESPONSE_URL, json=response_data, headers=headers)

            # Überprüfung der Antwort von der Ziel-Website
            if response.status_code == 200:
                print("Successfully sent response to target website.")

            else:
                # Debug Error Ruckgabe
                print(f"Failed to send response. Status code: {response.status_code}")
        except Exception as e:
            print(f"Error sending response: {e}")

