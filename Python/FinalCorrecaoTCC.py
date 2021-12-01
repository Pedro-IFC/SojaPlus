#importanto bibliotecas para aplicações matemáticas
import numpy as np
import random as rd

#importanto bibliotecas para o banco
import pymysql
con = pymysql.connect(host='localhost',user='root',password='',database='sojaplus',cursorclass=pymysql.cursors.DictCursor)
def getVal(elemento):
    if elemento == 'P':
        #quantidade(Pesquisa)
        x=[5, 15, 1, 1, 5, 26, 20, 25, 1, 25, 1, 1, 2, 20, 15, 25, 15, 1, 2, 2, 3, 20, 3, 3, 7, 10, 7, 10, 7, 7]

        #valor(Pesquisa)
        y=[36, 199, 20, 85, 34.9, 236 , 250, 190, 38, 268, 25.9, 13.59, 28, 287.04, 65.9, 140, 189, 24, 28.9, 27, 48.9, 190, 91.9, 79.1, 32, 63, 56, 53, 32, 47]
    elif elemento == 'K':
        #quantidade(Pesquisa)
        x=[5, 15, 1, 1, 5, 26, 20, 25, 1, 25, 1, 1, 2, 20, 15, 25, 15, 1, 2, 2, 3, 20, 3, 3, 7, 10, 7, 10, 7, 7]

        #valor(Pesquisa)
        y=[36, 199, 20, 85, 34.9, 236 , 250, 190, 38, 268, 25.9, 13.59, 28, 287.04, 65.9, 140, 189, 24, 28.9, 27, 48.9, 190, 91.9, 79.1, 32, 63, 56, 53, 32, 47]
    elif elemento == 'Mg':
        #quantidade(Pesquisa)
        x=[5, 15, 1, 1, 5, 26, 20, 25, 1, 25, 1, 1, 2, 20, 15, 25, 15, 1, 2, 2, 3, 20, 3, 3, 7, 10, 7, 10, 7, 7]

        #valor(Pesquisa)
        y=[36, 199, 20, 85, 34.9, 236 , 250, 190, 38, 268, 25.9, 13.59, 28, 287.04, 65.9, 140, 189, 24, 28.9, 27, 48.9, 190, 91.9, 79.1, 32, 63, 56, 53, 32, 47]
    elif elemento == 'Ca':
        #quantidade(Pesquisa)
        x=[5, 15, 1, 1, 5, 26, 20, 25, 1, 25, 1, 1, 2, 20, 15, 25, 15, 1, 2, 2, 3, 20, 3, 3, 7, 10, 7, 10, 7, 7]

        #valor(Pesquisa)
        y=[36, 199, 20, 85, 34.9, 236 , 250, 190, 38, 268, 25.9, 13.59, 28, 287.04, 65.9, 140, 189, 24, 28.9, 27, 48.9, 190, 91.9, 79.1, 32, 63, 56, 53, 32, 47]
    else:
        print('Erro: elemento não definido')

    #quantidade de valores em x e y
    lenX = len(x)
    lenY = len(y)

    #pré definindo os possíveis erros para considerarmos na regressão
    erro=np.random.normal(size=lenX)

    #quantidade x valor
    XxY=np.random.normal(size=lenX)
    i=0

    while i < lenX:
        #quantidade x valor
        XxY[i]=x[i]*y[i]
        i=i+1

    #quantidade²
    X2=np.random.normal(size=lenX)
    i=0

    while i < lenX:
    #quantidade x valor
        X2[i]=x[i]*x[i]
        i=i+1

    #somatorias(x, y, XxY, X2)

    #somatoria de X
    somatoriaX=0
    for val in x:
        somatoriaX=somatoriaX+val

    #somatoria de Y
    somatoriaY=0
    for val in y:
        somatoriaY=somatoriaY+val

    #somatoria de XxY
    somatoriaXxY=0
    for val in XxY:
        somatoriaXxY=somatoriaXxY+val

    #somatoria de X2
    somatoriaX2=0
    for val in X2:
        somatoriaX2=somatoriaX2+val
        
    #B=(n*somatoriaXY - somatoriaX*somatoriaY)/(n*somatoriaX2-somatoriaX*somatoriaX)
    bS=(lenX*somatoriaXxY)-(somatoriaX*somatoriaY)
    bI=(lenX*somatoriaX2)-(somatoriaX*somatoriaX)
    b=bS/bI
    
    #A=(somatoriaY-somatoriaX*B)/n
    aS=somatoriaY - b*somatoriaX
    a=aS/lenX
    
    #somatoria de erro
    somatoriaErro=erro[0]-erro[rd.randrange(1,lenY)]
    
    #equação final
    Nhectares=4
    Quant=66.8*Nhectares
    QuantN=Quant/10
    Val=round((a+b*QuantN - somatoriaErro)*10, 2)
    
    return Val
with con.cursor() as consulta:
    #obtendo dados do documento de analise do solo
    sql = "select * from docanalise group by idLavoura DESC;" # 
    consulta.execute(sql) 
    resposta = consulta.fetchall()
    for docanalise in resposta:
        #obtendo dados da lavoura
        id=docanalise['idLavoura']
        sql ="SELECT * FROM lavoura WHERE id = " + str(id)
        consulta.execute(sql) 
        lavoura = consulta.fetchone()
        
        #obtendo dados da soja
        sql ="SELECT * FROM SOJA WHERE idLavoura = " + str(id)
        consulta.execute(sql) 
        resposta = consulta.fetchone()
        estagio=resposta['estagio']
        
        #obtendo necessidade de fósforo(P)
        docP=docanalise['P']
        necessidadeP=round((50-(docP*2*142/31))*(100/20), 2)
        
        #obtendo necessidade de potássio(K) varia conforme o estágio
        docK=docanalise['K']
        if estagio == "V0":
            necessidadeK=round((50-(docK*2*94/39))*(100/25.51)*(1/3), 2)
        if estagio == "V3":
            necessidadeK=round((50-(docK*2*94/39))*(100/25.51)*(2/3), 2)
        if estagio =="R1": 
            necessidadeK=round((50-(docK*2*94/39))*(100/25.51), 2)
        
        #obtendo necessidade de magnésio(Mg)
        docMg=docanalise['Mg']
        if docMg<3:
            necessidadeMg=round((6-docMg*2)*(100/4.1), 2)
        else:
            necessidadeMg=0
        
        #obtendo necessidade de cálcio(Ca)
        docCa=docanalise['Ca']
        if docMg<3:
            necessidadeCa=round((6-docCa*2)*(100/2.5), 2)
        else:
            necessidadeCa=0
            
        #multiplica-se os valores pela quantidade de hectares do terreno
        necessidadeP=necessidadeP * lavoura['hectares']
        necessidadeK=necessidadeK * lavoura['hectares']
        necessidadeMg=necessidadeMg * lavoura['hectares']
        necessidadeCa=necessidadeCa * lavoura['hectares']
        
        #estimando quanto irá ser gasto para X quantidade de produto 
        valP=getVal('P')
        valK=getVal('K')
        valMg=getVal('Mg')
        valCa=getVal('Ca')
        
        #escrevendo o texto que será enviado ao usuário
        retornoP="Para adubar a lavoura serão necessários " + str(necessidadeP) + "Kg de P, logo serão gastos " + str(valP) + "R$<br>"
        
        retornoK=str(necessidadeK) + "Kg de K, logo serão gastos " + str(valK) + "R$"
        
        if necessidadeMg!=0:
            retornoMg=str(necessidadeMg) + "<br>Kg de Mg, logo serão gastos " + str(valMg) + "R$"
        else:
            retornoMg=""
        
        if necessidadeCa!=0:
            retornoCa=str(necessidadeCa) + "<br>Kg de Ca, logo serão gastos " + str(valCa) + "R$"
        else:
            retornoCa=""
        
        retorno=str(retornoP)+str(retornoK)+str(retornoMg)+str(retornoCa)
        
        #cadastrando correção no banco de dados
        consulta.execute("INSERT INTO correcao(idLavoura, retorno) VALUES ("+str(id)+", '"+str(retorno)+"')")
        # Efetua um commit no banco de dados.
        # Por padrão, não é efetuado commit automaticamente. Você deve commitar para salvar
        # suas alterações.
        con.commit()
        
        dados="Correção cadastrada"
        consulta.execute("INSERT INTO HISTORICO(idLavoura, dados) VALUES ("+str(id)+", '"+str(dados)+"')")
        con.commit()
