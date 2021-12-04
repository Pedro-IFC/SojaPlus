#importanto bibliotecas para aplicações matemáticas
import numpy as np
import random as rd

#importanto bibliotecas para o banco
import pymysql
con = pymysql.connect(
    host='localhost',
    user='root',
    password='',
    database='sojaplus',
    cursorclass=pymysql.cursors.DictCursor
)
def getVal(elemento, necessidade):
    if elemento == 'P':
        #quantidade(Pesquisa)
        x=[5, 15, 1, 1, 5, 26, 20, 25, 1, 25, 1, 1, 2, 20, 15, 25, 15, 1, 2, 2, 3, 20, 3, 3, 7, 10, 7, 10, 7, 7]

        #valor(Pesquisa)
        y=[36, 199, 20, 85, 34.9, 236 , 250, 190, 38, 268, 25.9, 13.59, 28, 287.04, 65.9, 140, 189, 24, 28.9, 27, 48.9, 190, 91.9, 79.1, 32, 63, 56, 53, 32, 47]
    elif elemento == 'K':
        #quantidade(Pesquisa)
        x=[1, 2, 5, 10, 15, 1, 2, 3]

        #valor(Pesquisa)
        y=[9.5, 49, 148, 330, 325, 24, 50, 62]
    elif elemento == 'Mg':
        #quantidade(Pesquisa)
        x=[1, 2, 3, 1, 1, 10, 3, 2, 3, 3, 2, 10, 2, 15, 2, 3, 20]
            
        #valor(Pesquisa)
        y=[24, 28, 32, 31, 23, 68, 55, 28, 33, 33, 29, 69, 105, 166, 41, 118, 260]
    elif elemento == 'Ca':
        #quantidade(Pesquisa)
        x=[1, 3, 2, 10, 25, 15]

        #valor(Pesquisa)
        y=[26, 39, 32, 78, 301, 239]
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
    Quant=necessidade*Nhectares
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
        N=(50-(docP*2*142/31))
        if(N>0):
            necessidadeP=round(N*(100/20), 2)
        else:
            necessidadeP=0
    
        #obtendo necessidade de potássio(K) varia conforme o estágio
        docK=docanalise['K']
        N=(50-(docK*2*94/39))
        if(N>0):
            if estagio == "V0":
                necessidadeK=round(N*(100/25.51)*(1/3), 2)
            if estagio == "V3":
                necessidadeK=round(N*(100/25.51)*(2/3), 2)
            if estagio =="R1": 
                necessidadeK=round(N*(100/25.51), 2)
        else:
            necessidadeK=0
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
        necessidadeP=necessidadeP/2 * lavoura['hectares']
        necessidadeK=necessidadeK/2 * lavoura['hectares']
        necessidadeMg=necessidadeMg/2 * lavoura['hectares']
        necessidadeCa=necessidadeCa/2 * lavoura['hectares']
        
        
        #escrevendo o texto que será enviado ao usuário
        retornoInit="Para adubar a lavoura serão necessários:"
        
        if necessidadeP!=0:
            #estimando quanto irá ser gasto para X quantidade de produto 
            valP=getVal('P',necessidadeP)
            retornoP=str(necessidadeP) + "Kg de P, logo serão gastos R$" + str(valP) + "<br>"
        else:
            valP=0
            retornoP=""
        
        if necessidadeK!=0:
            #estimando quanto irá ser gasto para X quantidade de produto 
            valK=getVal('K',necessidadeK)
            retornoK=str(necessidadeK) + "Kg de K, logo serão gastos R$ " + str(valK) + "<br>"
        else:
            valK=0
            retornoK=""
        
        if necessidadeMg!=0:
            #estimando quanto irá ser gasto para X quantidade de produto 
            valMg=getVal('Mg',necessidadeMg)
            retornoMg=str(necessidadeMg) + "Kg de Mg, logo serão gastos R$ " + str(valMg) + "<br>"
        else:
            retornoMg=""
            valMg=0
        
        if necessidadeCa!=0:
            #estimando quanto irá ser gasto para X quantidade de produto 
            valCa=getVal('Ca',necessidadeCa)
            retornoCa=str(necessidadeCa) + "Kg de Ca, logo serão gastos R$ " + str(valCa) + "<br>"
        else:
            valCa=0
            retornoCa=""
            
        retorno=str(retornoInit)+str(retornoP)+str(retornoK)+str(retornoMg)+str(retornoCa)
        if retorno==retornoInit :
            retorno = "Não é necessária mais adubação"
        
        #cadastrando correção no banco de dados
        consulta.execute("INSERT INTO correcao(idLavoura, retorno) VALUES ("+str(id)+", '"+str(retorno)+"')")
        # Efetua um commit no banco de dados.
        # Por padrão, não é efetuado commit automaticamente. Você deve commitar para salvar
        # suas alterações.
        con.commit()
        dados="Correção cadastrada"
        consulta.execute("INSERT INTO HISTORICO(idLavoura, dados) VALUES ("+str(id)+", '"+str(dados)+"')")
        con.commit()
        
        id=docanalise['idLavoura']
        sql ="SELECT count(*) FROM RECEITA WHERE idLavoura = " + str(id)
        consulta.execute(sql) 
        lucro=consulta.fetchall()
        if lucro[0]['count(*)'] == 0:
            #lucro médio por hectare
            lucroM=6109*lavoura['hectares']
            lucroF=lucroM-(valCa+valMg+valK+valP)
            consulta.execute("INSERT INTO RECEITA(idLavoura, receita) VALUES ("+str(id)+", '"+str(lucroF)+"')")
            con.commit()