close all ;
clc ;

w1 = 101;
w2 = 201;
s = strcat(num2str(w1),'.jpg')
s2 = strcat(num2str(w2),'.jpg')
img = imread(s);
img2 = imread(s2);

diff = imabsdiff(img,img2);
figure
imshow(diff);

diffGray = rgb2gray(diff);

figure
imshow(diffGray);

load trees

BW = im2bw(diffGray,map,0.4);
figure, imshow(BW)

