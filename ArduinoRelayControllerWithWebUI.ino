/*
   Wiring Arduino, Ethernet Shield, And 8Ch Rellay Modul
   Arduino + Ethernet Shield        Rellay Modul      External Power Supply 5V
   3.3v Or 5v                       VCC
   Digital Pin 2                    IN1
   Digital Pin 3                    IN2
   Digital Pin 4                    IN3
   Digital Pin 5                    IN4
   Digital Pin 6                    IN5
   Digital Pin 7                    IN6
   Digital Pin 8                    IN7
   Digital Pin 9                    IN8
                                    GND               GND
                                    JD-VCC            +5v

   Config IPAddress depend to your internet router config
   Upload Webinterface to Webserver
   char server[] = "192.168.10.8"; config this line to your webserver domain
*/


#include <SPI.h>
#include <Ethernet.h>

byte MAC[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};

IPAddress IP(192, 168, 10, 177);
IPAddress DNS(192, 168, 10, 1);

EthernetClient client;

char server[] = "192.168.10.8";

char inString[9]; // string for incoming serial data
int stringPos = 0; // string index counter
boolean startRead = false; // is reading?
unsigned long lastConnectionTime = 0;             // last time you connected to the server, in milliseconds
const unsigned long postingInterval = 5L * 1000L; // delay between updates, in milliseconds
// the "L" is needed to use long type numbers

void setup() {
  // start serial port:
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }

  // give the ethernet module time to boot up:
  delay(1000);
  // start the Ethernet connection using a fixed IP address and DNS server:
  Ethernet.begin(MAC, IP, DNS);
  // print the Ethernet board/shield's IP address:
  Serial.print("My IP address: ");
  Serial.println(Ethernet.localIP());


  pinMode(2, OUTPUT);
  pinMode(3, OUTPUT);
  pinMode(4, OUTPUT);
  pinMode(5, OUTPUT);
  pinMode(6, OUTPUT);
  pinMode(7, OUTPUT);
  pinMode(8, OUTPUT);
  pinMode(9, OUTPUT);

  digitalWrite(2, HIGH);
  digitalWrite(3, HIGH);
  digitalWrite(4, HIGH);
  digitalWrite(5, HIGH);
  digitalWrite(6, HIGH);
  digitalWrite(7, HIGH);
  digitalWrite(8, HIGH);
  digitalWrite(9, HIGH);
}

void loop() {
  // if there's incoming data from the net connection.
  // send it out the serial port.  This is for debugging
  // purposes only:
  if (client.available()) {
    char c = client.read();
    //Serial.print(c);

    if (c == '<' ) { //'<' is our begining character
      startRead = true; //Ready to start reading the part
    } else if (startRead) {
      if (c != '>') { //'>' is our ending character
        inString[stringPos] = c;
        stringPos ++;
      } else {
        //got what we need here! We can disconnect now
        startRead = false;
        client.stop();
        client.flush();
        Serial.println("disconnecting.");
        Serial.println(inString);

        for (int i = 0; i < sizeof(inString) - 1; i++) {
          if (inString[i] == '0') {
            digitalWrite(i + 2, HIGH);
          } else if (inString[i] == '1') {
            digitalWrite(i + 2, LOW);
          } else {
            digitalWrite(i + 2, HIGH);
          }
        }
      }
    }
  }

  // if ten seconds have passed since your last connection,
  // then connect again and send data:
  if (millis() - lastConnectionTime > postingInterval) {
    stringPos = 0;
    memset(&inString, 0, 32);
    httpRequest();
  }

}

// this method makes a HTTP connection to the server:
void httpRequest() {
  // close any connection before send a new request.
  // This will free the socket on the WiFi shield
  client.stop();

  // if there's a successful connection:
  if (client.connect(server, 80)) {
    Serial.println("connecting...");
    // send the HTTP GET request:
    client.println("GET /arduino-api/read_data.php HTTP/1.1");
    client.println("Host: 192.168.10.8");
    client.println("User-Agent: arduino-ethernet");
    client.println("Connection: close");
    client.println();

    // note the time that the connection was made:
    lastConnectionTime = millis();
  } else {
    // if you couldn't make a connection:
    Serial.println("connection failed");
  }
}
