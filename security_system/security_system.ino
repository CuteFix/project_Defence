#include <WiFi.h>
#include <HTTPClient.h>
#include "SPIFFS.h"
#include <SPI.h>
#include <FS.h>
#include <Ethernet.h>
#include <MFRC522.h>
#include "string"

#define RST_PIN         4
#define SS_PIN          2
MFRC522 mfrc522(SS_PIN, RST_PIN);
int card, uid;
char floatbufVar[32];
const int ledPinGreen = 15;
const int ledPinRed = 17;
const int ledPinYellow = 21;

const char *ssid = "Yra";
const char *password = "qwerr12345";

void setup() {
    delay(4000);
    SPIFFS.begin();
    SPI.begin();
    Serial.begin(115200);
    mfrc522.PCD_Init();
    pinMode(ledPinGreen, OUTPUT);
    pinMode(ledPinRed, OUTPUT);
    pinMode(ledPinYellow, OUTPUT);
    WiFi.begin(ssid, password);
    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.println("Connecting to WiFi..");
    }
    Serial.println("Connected to the WiFi network");
}

void loop() {
    if (!mfrc522.PICC_IsNewCardPresent() || !mfrc522.PICC_ReadCardSerial()) {
        return;
    }
    if ((WiFi.status() == WL_CONNECTED)) { //Check the current connection status
        HTTPClient http;
        String uid_;
        uid_ += mfrc522.uid.uidByte[1];
        uid_ += mfrc522.uid.uidByte[2];
        uid_ += mfrc522.uid.uidByte[3];
        uid_ += mfrc522.uid.uidByte[4];
        String request = "http://192.168.0.2/?uid=" + uid_;
        Serial.println(request);
        http.begin(request); //Specify the URL
        int httpCode = http.GET();//Make the request
        if (httpCode > 0) { //Check for the returning code
            std::string s = http.getString().c_str();
            Serial.println(httpCode);
            Serial.println(s.c_str());
            Serial.println("HTTP request");
            http.end(); //Free the resources
            if (s.find("1")!=std::string::npos) {//Если  есть в базе
                Serial.println("Open");
                digitalWrite(ledPinGreen, HIGH);
                delay(5000);
                digitalWrite(ledPinGreen, LOW);
            } else {
                digitalWrite(ledPinRed, HIGH);
                delay(100);
                digitalWrite(ledPinRed, LOW);
                Serial.println("closed");
            }
        } else {
            Serial.println(http.GET());
            Serial.println(httpCode);
            Serial.println("Error on HTTP request");
            String payload = http.getString();
            Serial.println(payload);
        }
    }
    digitalWrite(ledPinYellow, HIGH);
    delay(5000);
    digitalWrite(ledPinYellow, LOW);
}
