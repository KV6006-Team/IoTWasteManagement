// Libraries
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WifiClient.h>


//create clients
HTTPClient http;
WiFiClient wifiClient;

// WiFi network
const char* ssid     = "INPUT HERE";
const char* password = "INPUT HERE";

void setup() {
  
  // Start serial
  Serial.begin(115200);

  //get input pin for sensor
  pinMode(A0, INPUT);

  // Connecting to a WiFi network
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.hostname("CIS001");
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print("Connecting..");
  }

  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
//  Serial.print("Sensor 1:");
//  Serial.println(analogRead(A0));
//  Serial.println("--------------------------");
//  delay(1000);


  http.begin(wifiClient, "http://INPUT HERE/?location=CIS001&capacity="+String(analogRead(A0)));

  int httpCode = http.GET();
  String payload = http.getString();

  Serial.println(httpCode);
  Serial.println(payload);

  http.end();
    
  delay(3000);

}
  
