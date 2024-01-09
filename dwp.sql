DROP DATABASE IF EXISTS gamewebshop;

CREATE DATABASE gamewebshop;

USE gamewebshop;

CREATE TABLE `news` (
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `hero1` VARCHAR(100) NOT NULL,
    `hero2` VARCHAR(100) NOT NULL,
    `hero3` VARCHAR(100) NOT NULL,
    `wHead` VARCHAR(100) NOT NULL,
    `wMsg` TEXT NOT NULL,
    `sale` INT(3) NOT NULL,
    `date` INT(1) NOT NULL,
    `rate` INT(1) NOT NULL,
    `hours` VARCHAR(255) NOT NULL,
    `info` TEXT NOT NULL,
    `img` VARCHAR(255) NULL,
    `email` VARCHAR(255) NOT NULL
);

CREATE TABLE `accounts` ( 
    `ID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY, 
    `username` VARCHAR(80) NOT NULL UNIQUE, 
    `pass` VARCHAR(80) NOT NULL, 
    `Fname` VARCHAR(80) NULL, 
    `Lname` VARCHAR(80) NULL, 
    `email` VARCHAR(80) NOT NULL UNIQUE,  
    `description` TEXT NULL,
    `usertype` VARCHAR(50) DEFAULT 'user'
);

CREATE TABLE `product` (
	`id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	`Title` VARCHAR(255) NOT NULL UNIQUE,
	`Price` DECIMAL(5,2) NOT NULL,
	`ReleaseDate` DATE NOT NULL,
	`Description` TEXT NOT NULL,
	`Rating` DECIMAL(3,1),
	`Platform` VARCHAR(255) NOT NULL,
    `Genre` VARCHAR(255) NOT NULL
);

CREATE TABLE `media` (
	`mediaID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `Thumbnail` VARCHAR(255) NOT NULL,
	`Cover` VARCHAR(255) NOT NULL,
    `Trailer` VARCHAR (255) NOT NULL,
    `Screenshots` TEXT NOT NULL
);

CREATE TABLE `orders` (
	`orderID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `userID` INT NOT NULL,
	`Products` TEXT NOT NULL,
    `DeliveryEmail` VARCHAR(255) NOT NULL,
    `Date` VARCHAR (255) NOT NULL,
    `Price` DECIMAL(8,1) NOT NULL,
    `Status` VARCHAR(255) DEFAULT 'Pending'
);


CREATE VIEW `games` AS
SELECT * FROM product
JOIN media ON product.id = media.mediaID;

CREATE VIEW `invoices` AS
SELECT a.ID,a.Fname,a.Lname,o.* FROM accounts a
JOIN orders o ON a.ID = o.userID;

INSERT INTO accounts 
    (id, username, pass, Fname, Lname, email, description, usertype) 
 VALUES -- Password = 123456
    (1, 'Solanum', '$2y$15$2a0at2IhmJ9wyyply93qauT7yP/.JgxzWohC.YhdYc9266YaP8VyS', 'Solanum', 'Nomai', 'Echoes@Eye.com', 'Last surviving nomai seeking the eye of the universe.', 'admin');

INSERT INTO news 
    (id, hero1, hero2, hero3, wHead, wMsg, sale, date, rate, hours, info, img, email) 
VALUES
    (1, 'Digital codes.', 'Instant delivery.', 'Best price on the market.', 'A new challenger enters the Arena...', '
    Welcome dear customers, we\'re glad to announce ourselves as the new best place to get your gaming needs satisfied. Feel free to browse the amazing products and prizes. Don\'t be afraid to send us a mail under the contact tab in the menu. We\'d love to hear from you. Sincerely, DWP games.
    ', 200, 3, 8, '24/7. As soon as the transaction goes through, the game key will automatically be sent to your mail.', '
    We here at DWP games are a collection of video game loving nerds who just want to take a minute of your time to talk about Games. Based in Esbjerg, Denmark, we\'re a small company yet our concerns are big, one of them being how do we get the games to you as fast as possible? That\'s right! Game Keys! That\'s our livelyhood right here, selling these keys for a reasonable price, but the main fruits of our labor is just seeing you, the gamers, fulfilled to your little cores. So come on down to DWP Games and get ya some real authentic game keys! The way it works is easy, there\'s just two steps to the process: - Pick a game. - Complete Transaction. Bada boom bada bing, check your email! When you open that mail there\'s your code, all that\'s left to do is redeem it on the account of your choosing. Sincerely, DWP GAMES
    ', 'logo.png', 'test123@finklesnout.design');

-- ' We here at DWP games are a collection of video game loving nerds who just want to take a minute of your time to talk about Games. <br> Based in Esbjerg, Denmark, we\'re a small company yet our concerns are big, one of them being how do we get the games to you as fast as possible? <br> That\'s right! <b>Game Keys!</b> <br> That\'s our livelyhood right here, selling these keys for a reasonable price, but the main fruits of our labor is just seeing you, the gamers, fulfilled to your little cores.  So come on down to DWP Games and get ya some real authentic game keys!<br><br> The way it works is easy, there\'s just two steps to the process: <br>- Pick a game. <br>- Complete Transaction. <br><br>Bada boom bada bing, check your email! <br> <br>When you open that mail there\'s your code, all that\'s left to do is redeem it on the account of your choosing.<br><br><br>Sincerely,<br>DWP GAMES '
INSERT INTO product 
    (id, Title, Price, ReleaseDate, Description, Rating, Platform, Genre) 
VALUES 
    (1, 'Ghost Of Tsushima', 445, '2020-07-17', 'Uncover the hidden wonders of Tsushima in this open-world action adventure from Sucker Punch Productions and PlayStation Studios, available for PS5 and PS4. Forge a new path and wage an unconventional war for the freedom of Tsushima. Challenge opponents with your katana, master the bow to eliminate distant threats, develop stealth tactics to ambush enemies and explore a new story on Iki Island.', 9.5, 'PS4/PS5', 'Action/Adventure'),
    (2, 'Bloodborne', 225, '2015-03-24', 'Hunt your nightmares as you search for answers in the ancient city of Yharnam, now cursed with a strange endemic illness spreading through the streets like wildfire. Danger, death and madness lurk around every corner of this dark and horrific world, and you must discover its darkest secrets in order to survive.', 10, 'PS4/PS5', 'Action/RPG'),
    (3, 'Outer Wilds', 240, '2019-05-28', 'Welcome to the Space Program! You are the newest recruit of Outer Wilds Ventures, a fledgling space program searching for answers in a strange, constantly evolving solar system.', 10, 'PS4/XBOX ONE/Nintendo/PC', 'Adventure'),
    (4, 'Bioshock', 190, '2007-08-21', 'BioShock is a shooter unlike any you have ever played, loaded with weapons and tactics never seen. You will have a complete arsenal at your disposal from simple revolvers to grenade launchers and chemical throwers, but you will also be forced to genetically modify your DNA to create an even more deadly weapon: you. Injectable plasmids give you super human powers: blast electrical currents into water to electrocute multiple enemies, or freeze them solid and obliterate them with the swing of a wrench. No encounter ever plays out the same, and no two gamers will play the game the same way.', 8.6, 'PS3/PS4/PC/XBOX 360/XBOX ONE','FPS'),
    (5, 'Far Cry 6', 460, '2021-10-06', 'Welcome to Yara, a tropical paradise frozen in time. As the dictator of Yara, Antón Castillo is intent on restoring his nation back to its former glory by any means, with his son, Diego, following in his bloody footsteps. Their oppressive rule has ignited a revolution.', 3.4, 'PS4/PS5/XBOX ONE/XBOX SERIES X/PC','FPS'),
    (6, 'Horizon Zero Dawn', 150, '2017-02-28', 'In an era where Machines roam the land and mankind is no longer the dominant species, a young hunter named Aloy embarks on a journey to discover her destiny. In a lush, post apocalyptic world where nature has reclaimed the ruins of a forgotten civilization, pockets of humanity live on in primitive hunter and gatherer tribes. Their dominion over the new wilderness has been usurped by the Machines, fearsome mechanical creatures of unknown origin.', 8.4, 'PS4/PS5','Action/Adventure'),
    (7, 'Risk of Rain 2', 185, '2020-08-11', 'SURVIVE AN ALIEN PLANET! Over a dozen handcrafted locales await, each packed with challenging monsters and enormous bosses that oppose your continued existence. Fight your way to the final boss and escape or continue your run indefinitely to see just how long you can survive. A unique scaling system means both you and your foes limitlessly increase in power over the course of a game.', 9, 'PS4/XBOX ONE/Nintendo/PC','Roguelike/Action'),
    (8, 'The Last Of Us 2', 445, '2020-06-19', ' Five years after their dangerous journey across the post-pandemic United States, Ellie and Joel have settled down in Jackson, Wyoming. Living amongst a thriving community of survivors has allowed them peace and stability, despite the constant threat of the infected and other, more desperate survivors. When a violent event disrupts that peace, Ellie embarks on a relentless journey to carry out justice and find closure. As she hunts those responsible one by one, she is confronted with the devastating physical and emotional repercussions of her actions.', 5.7, 'PS4/PS5','Action/Adventure/Horror');

INSERT INTO media
    (mediaID, Thumbnail, Cover, Trailer, Screenshots) 
VALUES 
    (1, 'https://upload.wikimedia.org/wikipedia/en/b/b6/Ghost_of_Tsushima.jpg', 'https://gameranx.com/wp-content/uploads/2020/07/ghost-ost-featured.jpg', 'https://www.youtube.com/embed/b_iU_gnn28U', 'https://thecenturionreport.com/wp-content/uploads/2021/08/find-all-the-hot-springs.jpeg, https://robinsgames.com/wp-content/uploads/2020/11/Ghost-of-Tsushima-Review-Summary-of-the-Ghost-of-Tsushima-game-plot.jpg, https://i.guim.co.uk/img/media/c39bf8486b167ff4d297f4db15efe4e18078df98/683_269_2713_1628/master/2713.jpg?width=1200&quality=85&auto=format&fit=max&s=1134351c5ddce61338e3b3fb673166a6'),
    (2, 'https://i1.sndcdn.com/artworks-000117752385-zhasx1-t500x500.jpg', 'https://image.api.playstation.com/vulcan/img/rnd/202010/2614/O2Z66UWrZH8zcejxopwWxhGu.png', 'https://www.youtube.com/embed/G203e1HhixY', 'https://i0.wp.com/gamerfocus.co/wp-content/uploads/2015/09/Bloodborne-The-Old-Hunters.jpg?ssl=1, https://media.wired.com/photos/5955c1dc5992c54331ac192f/master/pass/bloodborne_the_old_hunters_V2.jpg'),
    (3, 'https://i1.sndcdn.com/artworks-000655287109-o7nxm0-t500x500.jpg', 'https://i.ytimg.com/vi/Sm7UlgK5HOw/maxresdefault.jpg','https://www.youtube.com/embed/KYlpUxFbgTM',  'https://www.pcinvasion.com/wp-content/uploads/2019/05/outer-wilds-1-1200x675.jpg, https://cdn.pastemagazine.com/www/articles/2019/05/31/outer%20wilds%20feature%20m%20ain.jpg, https://sm.ign.com/ign_nordic/news/o/outer-wild/outer-wilds-is-coming-to-switch_yhkx.jpg'),
    (4, 'https://www.mobygames.com/images/covers/l/662249-bioshock-remastered-nintendo-switch-front-cover.jpg', 'https://cdn02.nintendo-europe.com/media/images/10_share_images/games_15/nintendo_switch_4/H2x1_NSwitch_BioshockRemastered.jpg', 'https://www.youtube.com/embed/_KVfPMSK8hA', 'https://cdn.vox-cdn.com/thumbor/88lmW_GOa15KgdwJzKoHKVXmGRE=/0x0:1280x720/1200x800/filters:focal(538x258:742x462)/cdn.vox-cdn.com/uploads/chorus_image/image/66917458/bioshock_the_collection_switch_screenshot02.0.jpg, https://cdn.mos.cms.futurecdn.net/d4132487bf648572736e71934de13be7.jpg'),
    (5, 'https://upload.wikimedia.org/wikipedia/en/3/35/Far_cry_6_cover.jpg', 'https://images.eurogamer.net/2021/articles/2021-10-07-14-29/far_cry_6_lead.jpg', 'https://www.youtube.com/embed/-IJuKT1mHO8', 'https://gmedia.playstation.com/is/image/SIEPDC/far-cry-6-comeback-shredder-screen-01-ps4-ps5-en-30jun21?$native$, https://assets2.rockpapershotgun.com/far-cry-6-crossbow-and-crocs.jpg/BROK/resize/1920x1920%3E/format/jpg/quality/80/far-cry-6-crossbow-and-crocs.jpg'),
    (6, 'https://s2.gaming-cdn.com/images/products/6202/orig/spil-steam-horizon-zero-dawn-complete-edition-cover.jpg', 'https://image.api.playstation.com/vulcan/ap/rnd/202010/0221/1jE1dG7sSfbJnhoRfAeVc2rs.png?w=1024', 'https://www.youtube.com/embed/u4-FCsiF5x4', 'https://cdn.vox-cdn.com/thumbor/Qxdbz7ojsJMqKYcL8SLS9T8oXTk=/0x0:1920x1080/1200x800/filters:focal(807x387:1113x693)/cdn.vox-cdn.com/uploads/chorus_image/image/68982682/Aiming_at_Thunderjaw.0.0.png, https://variety.com/wp-content/uploads/2019/03/hzdaloy.jpeg, https://images0.persgroep.net/rcs/GvJrsEQ6TjdoOZ67v9K6cVpiM7k/diocontent/128897753/_focus/0.29/0.63/_fill/1200/630/?appId=21791a8992982cd8da851550a453bd7f&quality=0.7'),
    (7, 'https://cdn2.steamgriddb.com/file/sgdb-cdn/grid/f8dc3073b73dfb018693b7a1dbfcef43.png', 'https://www.destructoid.com/wp-content/uploads/2020/12/599553-header.jpg', 'https://www.youtube.com/embed/pJ-aR--gScM', 'https://gamingbolt.com/wp-content/uploads/2020/08/risk-of-rain-2-image-4.jpg, https://image.jeuxvideo.com/medias-md/159828/1598279048-1030-capture-d-ecran.png'),
    (8, 'https://direct.rhapsody.com/imageserver/images/alb.482944940/500x500.jpg', 'https://cdn.mos.cms.futurecdn.net/CEajpQcrXWZQHMMDqoF3zF.jpeg', 'https://www.youtube.com/embed/vhII1qlcZ4E', 'https://sm.ign.com/ign_nordic/news/t/the-last-o/the-last-of-us-part-2-is-getting-a-ps5-exclusive-performance_s43z.jpg, https://media.npr.org/assets/img/2021/02/25/2510225ed61038a780b9.08969556-tloupii_preview_screenshot_04_wide-933bf2d68d635cd07832685ab3b2ed887e1d249e.jpg, https://media.wired.com/photos/5edfe6ec39276c283696879a/master/pass/culture_tlou2_1.jpg');
