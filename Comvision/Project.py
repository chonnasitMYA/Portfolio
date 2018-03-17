# -*- coding: utf-8 -*-
"""
Spyder Editor

This is a temporary script file.
"""

import cv2,numpy
import urllib2
import sys, pygame
import time

def contour_iterator(contour):
        while contour:
                yield contour
                contour = contour.h_next()
                
setup=1
z=0
sec=0
tlimit=30

while True:
    if setup==1:
        sec=0
        put=0
        H=1
        A=0
        B=0
        AX=0
        BX=0
        w=1
        w1=101
        w2=201
        won=0
        loss=0
        xx=1
        pygame.init()
        size = width,height=800,600
        speed =[10,10]
        black= 255,255,255
        screen = pygame.display.set_mode(size)
        #pygame.display.set_caption("Cute Girl Photo")
        bg = pygame.image.load('bg.jpg') 
        start=False
        setup=0
        
        verdana = pygame.font.match_font('Verdana')
        verdanaFont=pygame.font.Font(verdana,30)
        fonts = pygame.font.get_fonts()
        text1=verdanaFont.render(str("TIME"),1,(0,0,255),(255,255,255))
        rect1=text1.get_rect()
        rect1.x,rect1.y = 350,550
    if xx==1:
        screen.blit(bg,(0,0))
        pygame.display.flip()
        
        for event in pygame.event.get():
            check = pygame.key.get_pressed()
            
            if check[pygame.K_RETURN]:
                start = True
                break
            if event.type == pygame.QUIT:
                sys.exit()
            elif event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
                sys.exit()
                
    while start:
        pygame.display.set_caption("Cute Girl Photo")
        z = z+1
        if z>=70:
            sec = sec+1
            z=0
            text1 = verdanaFont.render(str("TIME :"+str(tlimit-sec)),1,(0,0,255),(255,255,255))
            rect1 = text1.get_rect()
            rect1.x,rect1.y=350,350
        if tlimit-sec <=0:
            loss = 1
            
        if H==1:
            pygame.display.set_caption("Cute Girl Photo")
            H=0
            img = cv2.LoadImage(str(w1)+'.jpg')
            img2 = cv2.LoadImage(str(w2)+'.jpg')
            
            m1 = cv2.CreateImage((img.width,img.height),8,1)
            m2 = cv2.CreateImage((img.width,img.height),8,1)
            AF = cv2.CreateImage((img.width,img.height),8,3)
            cv2.Threshold(m1,AF1,60,255,cv2,CV_THRESH_BINARY)
            
            a1 = [0,0,0,0,0,0,0]
            a2 = [0,0,0,0,0,0,0]  
            
            color = cv2.CV_RGB(0,255,0)
            stor = cv2.CreateMemStorage(0)
            
            cont = cv2.FindContours(AF1,stor,cv2.CV_RETR_LIST,cv2.CV_CHAIN_APPROX_NONE,(0,0))
            CE = 0
            
            for c in contour_iterator(cont):
                if len(C) >= 6:
                    CE = CE + 1
                    PointArray2D32fBWC = cv2.CreateMat(1, len(C),cv2.CV_32FC2)
                    for (i,(x,y)) in enumerate(C):
                        PointArray2D32fBWC[0,i] = (x,y)
                    (center, size, angle) = cv2.FitEllipse2(PointArray2D32fBWC)
                    cv2.Ellipse(img, center, size, angle, 0,360, color, 2,cv2.CV_AA,0)
                    cv2.Circle(m1,center,40,cv2.CV_RGB(255,0,0),2,8,0)
                    print center
                    
                    a1[CE-1] = center[0]
                    a2[CE-1] = center[1]
                    
            print CE
            print len(C)
            
            pygame.init()
            size = width, height = 800, 600
            speed = [10,10]
            black = 255,255,255
            screen = pygame.display.set_mode(size)
            pygame.display.set_caption("Cute Girl PHOTO HUNT")
            intro = pygame.image.load(str(w) + '.jpg')
           
        if H == 0:
            
            if A == 1:
                print "00000000000000LLLLLLL"
                A = 0
                AX = AX + 1
                print AX
                
                if AX == 5:
                    print "WWWWWWWWWWWWWWOOOOOOOOOOOOOOOONNNNNNNNNNNN"
                    sec = 0
                    won = won + 1
                    AX = 0
                    H = 1
                    w = w + 1
                    w1 = w1 + 1
                    w2 = w2 + 1
                    
            if B == 1:
                B = 0
                BX = BX + 1
                if BX == 3:
                    loss = 1
                    
            if put == 1:
                B = 1
                print "OKKKKKKK"
                print event.pos
                print event.pos[0] + 400
                               
                if(event.pos[0] > a1[0]-30 and event.pos[0] < a1[0]+30) or (event.pos[0] > (a1[o]+400)-30 and event.pos[o] < (a1[0]+400)+30):
                    print "YYYYYYYYYYYYYYYYY"
                    put = 0
                    if event.pos[1] > a2[0] - 30 and event.pos[1] < a2[0] +30 :
                        print "UUUUUUUUU"
                        cv2.Circle(img,event.pos,40,cv2.CV_RGB(255,0,0),2,8,0)
                        pygame.draw.circle(intro,(255,0,0),(a1[0],a2[0]),40,2)
                        pygame.draw.circle(intro,(255,0,0),(a1[0]+400,a2[0]),40,2)
                        A = 1
                        B = 0
                
                if(event.pos[0] > a1[1]-30 and event.pos[0] < a1[1]+30) or (event.pos[0]>(a1[1]+400)-30 and evnet.pos[0] < (a1[1]+400)+30):
                    print "YYYYYYYYYYYYYYYYY"
                    put=0
                    if event.pos[1] > a2[1]-30 and event.pos[1] < a2[1]+30 :
                        print "UUUUUUUUU"
                        cv2.Circle(img,event.pos,40,cv2,CV_RGB(255,0,0),2,8,0)
                        pygame.draw.circle(intro,(255,0,0),(a1[1],a2[1]),40,2)
                        pygame.draw.circle(intro,(255,0,0),(a1[1]+400,a2[1]),40,2)
                        A=1
                        B=0
                if(event.pos[0] > a1[2]-30 and event.pos[0] < a1[2]+30) or (event.pos[0]>(a1[2]+400)-30 and evnet.pos[0] < (a1[2]+400)+30):
                    print "YYYYYYYYYYYYYYYYY"
                    put=0
                    if event.pos[1] > a2[2]-30 and event.pos[1] < a2[2]+30 :
                        print "UUUUUUUUU"
                        cv2.Circle(img,event.pos,40,cv2,CV_RGB(255,0,0),2,8,0)
                        pygame.draw.circle(intro,(255,0,0),(a1[2],a2[2]),40,2)
                        pygame.draw.circle(intro,(255,0,0),(a1[2]+400,a2[2]),40,2)
                        put=0
                        A=1
                        B=0
                if(event.pos[0] > a1[3]-30 and event.pos[0] < a1[3]+30) or (event.pos[0]>(a1[3]+400)-30 and evnet.pos[0] < (a1[3]+400)+30):
                    print "YYYYYYYYYYYYYYYYY"
                    put=0
                    if event.pos[1] > a2[3]-30 and event.pos[1] < a2[3]+30 :
                        print "UUUUUUUUU"
                        cv2.Circle(img,event.pos,40,cv2,CV_RGB(255,0,0),2,8,0)
                        pygame.draw.circle(intro,(255,0,0),(a1[3],a2[3]),40,2)
                        pygame.draw.circle(intro,(255,0,0),(a1[3]+400,a2[3]),40,2)
                        put=0
                        A=1
                        B=0
                if(event.pos[0] > a1[4]-30 and event.pos[0] < a1[4]+30) or (event.pos[0]>(a1[4]+400)-30 and evnet.pos[0] < (a1[4]+400)+30):
                    print "YYYYYYYYYYYYYYYYY"
                    put=0
                    if event.pos[1] > a2[4]-30 and event.pos[1] < a2[4]+30 :
                        print "UUUUUUUUU"
                        cv2.Circle(img,event.pos,40,cv2,CV_RGB(255,0,0),2,8,0)
                        pygame.draw.circle(intro,(255,0,0),(a1[4],a2[4]),40,2)
                        pygame.draw.circle(intro,(255,0,0),(a1[4]+400,a2[4]),40,2)
                        put=0
                        A=1
                        B=0
                put=0
            screen.blit(intro, (0,0))
            screen.blit(text1,rect1)
            pygame.display.flip()
            
            for event in pygame.event.get():
                if event.type == pygame.QUIT :
                    sys.exit()
                elif event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
                    sys.exit()
                elif event.type == pygame.MOUSEBUTTONDOWN and pygame.mouse.get_pressed()[0]:
                    print "PASSSSSSSS"
                    print event.pos
                    put =1
                    
            if won == 5:
                print "YOU WIN"
                screen.blit(win,(0,0))
                pygame.display.flip()
                swin.play()
                while True:
                    for event in pygame.event.get():
                        check = pygame.key.get_pressed()
                        if check[pygame.KRETURN]:
                            start = False
                            setup = 1
                            xx=1
                            swin.stop()
                            print " QQQQQQQQQQQ"
                            print "win"
                            break
                        if event.type == pygame.QUIT :
                            sys.exit()
                        elif event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
                            sys.exit()
                    if xx==1:break
                
                if loss ==1:
                    loss=0
                    print "LOOOOOOSSSSSEEEE"
                    screen.blit(lost,(0,0))
                    pygame.display.flip()
                    slose.play()
                    while True:
                        
                        for event in pygame.event.get():
                            check = pygame.key.get_pressed()
                            if check[pygame.K_RETURN]:
                                start = False
                                setup=1
                                xx=1
                                slose.stop()
                                print " QQQQQQQQQQQ"
                                print loss
                                break
                            if event.type == pygame.QUIT:
                                sys.exit()
                            elif event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
                                sys.exit()
                        if xx==1:
                            break
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    
                        
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
