clear all
close all

for i = 0 : 37
    w1 = 101+i;
    w2 = 201+i;

    s = strcat(num2str(w1),'.jpg')
    s2 = strcat(num2str(w2),'.jpg')
    img = imread(s);
    img2 = imread(s2);
    subplot(1,2,1),imshow(img);
    subplot(1,2,2),imshow(img2);
    pause;
    diff = imabsdiff(img,img2);
    diffGray = rgb2gray(diff);
    load trees

    BW = im2bw(diffGray,map,0.3);




    S = strel('disk', 5, 0);
    I2 = imdilate(BW,S);
    % imshow(BW);

    B = im2bw(uint8(I2), graythresh(uint8(I2))); % Threshold image




    L = bwlabel(B); % Do connected component labeling

    blobs = regionprops(L); % Get region properties

    subplot(1,2,1),imshow(img);


    for i=1:length(blobs)

        % Draw a rectangle around each blob
        if blobs(i).BoundingBox(3) > 30  
        r = rectangle('Position',blobs(i).BoundingBox);

        r.EdgeColor = 'b';
        r.LineWidth = 2;

        % Draw crosshair at center of each blob

        c = blobs(i).Centroid; % Get centroid of blob

        line([c(1)-5 c(1)+5], [c(2) c(2)], 'Color', 'g');

        line([c(1) c(1)], [c(2)-5 c(2)+5], 'Color', 'g');
        end
    end

    subplot(1,2,2),imshow(img2);

    for i=1:length(blobs)

    % Draw a rectangle around each blob
        if blobs(i).BoundingBox(3) > 30  
            r = rectangle('Position',blobs(i).BoundingBox);

            r.EdgeColor = 'b';
            r.LineWidth = 2;
            % rectangle('Position', blobs(i).BoundingBox, 'EdgeColor', 'r');

            % Draw crosshair at center of each blob

            c = blobs(i).Centroid; % Get centroid of blob

            line([c(1)-5 c(1)+5], [c(2) c(2)], 'Color', 'g');

            line([c(1) c(1)], [c(2)-5 c(2)+5], 'Color', 'g');
        end
     end

pause;


end