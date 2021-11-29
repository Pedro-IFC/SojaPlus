//includes basicos

#include <math.h>                                                         // Incluimos a biblioteca Math

// Configuração do DHT
#include <DHT.h>                                                          // Incluimos a biblioteca DHT
#define DHTPIN A0                                                         // Pino analógico do DHT11
#define DHTTYPE DHT11                                                     // DHT 11
DHT dht(DHTPIN, DHTTYPE);                                                 // Declarando passando as funções da biblioteca para a variavel   


void setup() {
  Serial.begin(9600);                                                     // Iniciamos a comunicação serial
  dht.begin();                                                            // Iniciamos o dht   
}
 
void loop() {
  float t = dht.readTemperature();
  float ua = dht.readHumidity(); 
  float u = analogRead(A1);                                    
  Serial.print("Temperatura do ar: ");                                        
  Serial.println(t);                                
  Serial.print("Umidade do ar: ");                                        
  Serial.println(ua);                                                 
  Serial.print("Umidade do solo: ");                                        
  Serial.println(u);
  delay(2000);                                                            
}
