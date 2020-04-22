#include <WiFi.h>
#include <HTTPClient.h>
#include "SPIFFS.h"
#include <SPI.h>
#include <FS.h>    
#include <Ethernet.h>
#include <MFRC522.h>   


#define RST_PIN         4         
#define SS_PIN          2    
MFRC522 mfrc522(SS_PIN, RST_PIN);   
int card,uid;
char floatbufVar[32]; 
const int ledPinGreen = 15;
const int ledPinRed = 17;
const int ledPinYellow = 21;
 
const char* ssid = "WiFiId";
const char* password =  "password";

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
  if ((WiFi.status() == WL_CONNECTED)) { //Check the current connection status
 
    HTTPClient http;
    //for (int i=0; i<=quantity_; i++){
    http.begin("http://192.168.0.2/"); //Specify the URL

     //}

    int httpCode = http.GET();                                        //Make the request

    if (httpCode > 0) { //Check for the returning code
        String s = http.getString();
        //int countint=atoi(count);
        Serial.println(httpCode);
        
        Serial.println(s);
        Serial.println("HTTP request");

        int i = 0, c = 0;
        do { c++; } while ((i = s.indexOf(',', ++i)) > 0);
        unsigned int rawData[c];
        i = 0;
         c = 0;
        int ix = 0;
        String ts;
        do {
        ix = s.indexOf(',', i + 1);
        ts = s.substring(i, ix);
        rawData[c] = (unsigned int)ts.toInt();
        Serial.println(rawData[c]);
        c++;
        } while ((i = s.indexOf(',', ++i) + 1) > 0);
http.end(); //Free the resources
//........................
if ( ! mfrc522.PICC_IsNewCardPresent() || ! mfrc522.PICC_ReadCardSerial() ) {
                delay(2000);
           return;
        }
     String uid_;  
     uid_ += mfrc522.uid.uidByte[1];     
     uid_ += mfrc522.uid.uidByte[2];
     uid_ += mfrc522.uid.uidByte[3];
     uid_ += mfrc522.uid.uidByte[4];  


        http.begin("http://192.168.0.2/count.php");
        int httpCode = http.GET();
        String count = http.getString();
        Serial.println(count);

     
     uid_.toCharArray(floatbufVar,sizeof(floatbufVar));
     card=atof(floatbufVar);
     Serial.print("Card UID: ");
     Serial.println(card );
     int quantity_ = count.toInt();//количество записей в базе
     Serial.println(quantity_);
     for (int i=0; i<=quantity_; i++){
     if (card == rawData[i]) {//Если  есть в базе
         Serial.println("Open");
         digitalWrite(ledPinGreen, HIGH);
              delay(5000);
              digitalWrite(ledPinGreen, LOW); 
              i=rawData[i];
              i++;
              break;
         }else {
          digitalWrite(ledPinRed, HIGH);
          delay(100);
          digitalWrite(ledPinRed, LOW); 
          Serial.println("closed");
          
         }
         
     }
//........................
        
      }
 
    else {
      Serial.println(http.GET());
      Serial.println(httpCode);
      Serial.println("Error on HTTP request");
      String payload = http.getString();
      Serial.println(payload);
    }
 
    http.end(); //Free the resources
  }
 digitalWrite(ledPinYellow, HIGH);
  delay(5000);
 digitalWrite(ledPinYellow, LOW);
}
