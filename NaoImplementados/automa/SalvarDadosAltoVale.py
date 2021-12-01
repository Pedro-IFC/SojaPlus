import pyautogui 
import time 
import pyperclip
from datetime import datetime

cidades= ["Agrolândia", "Agronômica", "Atalanta", "Aurora", "Braço do Trombudo", "Chapadão do Lageado", "Dona Emma", "Ibirama", "Imbuia", "Ituporanga", "José Boiteux", "Laurentino", "Lontras", "Mirim Doce", "Petrolândia", "Pouso Redondo", "Presidente Getúlio", "Presidente Nereu", "Rio do Campo", "Rio do Oeste", "Rio do Sul", "Salete", "Santa Terezinha", "Taió", "Trombudo Central", "Vidal Ramos", "Vitor Meireles", "Witmarsum"]
pyautogui.PAUSE=1

for x in cidades:
    dataTime=datetime.today()
    diretorio=str('C:\\xampp\\htdocs\\TCC\\dados-sem nome real\\' + x + "\\weatherAPI.txt")
    pyautogui.hotkey("win", "r")
    pyperclip.copy(diretorio)
    pyautogui.hotkey('ctrl', 'v')
    pyautogui.press('enter')
    pyperclip.copy(str(dataTime))
    pyautogui.hotkey('ctrl', 'v')
    pyautogui.write(':')
    pyautogui.hotkey("alt", "tab")
    pyautogui.hotkey("ctrl", "t")
    pyperclip.copy('http:///api.openweathermap.org/data/2.5/weather?q='+ x +'&appid=917700fd8cd6cd576ae25c0ea8ea95e7')
    pyautogui.hotkey('ctrl', 'v')
    pyautogui.press('enter')
    pyautogui.hotkey("ctrl", "a")
    pyautogui.hotkey("ctrl", "c")
    pyautogui.hotkey('ctrl', 'w')
    pyautogui.hotkey('alt', 'tab')
    pyautogui.hotkey('ctrl', 'v')
    pyautogui.press('enter')
    pyautogui.hotkey("ctrl", "s")
    pyautogui.hotkey('ctrl', 'w')

pyautogui.alert("Processo finalizado com sucesso")