-- SQL script to add English translation columns to the tables

-- Site Settings
ALTER TABLE site_settings ADD COLUMN site_name_en VARCHAR(255) NULL AFTER site_name;
ALTER TABLE site_settings ADD COLUMN site_title_en VARCHAR(255) NULL AFTER site_title;
ALTER TABLE site_settings ADD COLUMN site_description_en TEXT NULL AFTER site_description;
ALTER TABLE site_settings ADD COLUMN seo_title_en VARCHAR(255) NULL AFTER seo_title;
ALTER TABLE site_settings ADD COLUMN seo_description_en TEXT NULL AFTER seo_description;
ALTER TABLE site_settings ADD COLUMN seo_keywords_en TEXT NULL AFTER seo_keywords;
ALTER TABLE site_settings ADD COLUMN address_en VARCHAR(255) NULL AFTER address;

-- Frontend Widgets
ALTER TABLE frontend_widgets ADD COLUMN title_en VARCHAR(255) NULL AFTER title;
ALTER TABLE frontend_widgets ADD COLUMN sub_title_en VARCHAR(255) NULL AFTER sub_title;
ALTER TABLE frontend_widgets ADD COLUMN description_en TEXT NULL AFTER description;
ALTER TABLE frontend_widgets ADD COLUMN settings_en JSON NULL AFTER settings;

-- Categories
ALTER TABLE categories ADD COLUMN name_en VARCHAR(255) NULL AFTER name;
ALTER TABLE categories ADD COLUMN description_en TEXT NULL AFTER description;

-- Products
ALTER TABLE products ADD COLUMN name_en VARCHAR(255) NULL AFTER name;
ALTER TABLE products ADD COLUMN short_description_en TEXT NULL AFTER short_description;
ALTER TABLE products ADD COLUMN description_en LONGTEXT NULL AFTER description;
ALTER TABLE products ADD COLUMN seo_title_en VARCHAR(255) NULL AFTER seo_title;
ALTER TABLE products ADD COLUMN seo_description_en TEXT NULL AFTER seo_description;

-- Posts
ALTER TABLE posts ADD COLUMN title_en VARCHAR(255) NULL AFTER title;
ALTER TABLE posts ADD COLUMN description_en TEXT NULL AFTER description;
ALTER TABLE posts ADD COLUMN content_en LONGTEXT NULL AFTER content;
ALTER TABLE posts ADD COLUMN seo_title_en VARCHAR(255) NULL AFTER seo_title;
ALTER TABLE posts ADD COLUMN seo_description_en TEXT NULL AFTER seo_description;

-- Menu Items
ALTER TABLE menu_items ADD COLUMN label_en VARCHAR(255) NULL AFTER label;
ALTER TABLE menu_items ADD COLUMN url_en VARCHAR(255) NULL AFTER url;

-- Experts
ALTER TABLE experts ADD COLUMN role_en VARCHAR(255) NULL AFTER role;
ALTER TABLE experts ADD COLUMN description_en TEXT NULL AFTER description;

-- Update Menu Items with English Translations
UPDATE menu_items SET label_en = 'Home', url_en = '/' WHERE id = 1;
UPDATE menu_items SET label_en = 'About Us', url_en = '/en/about' WHERE id = 2;
UPDATE menu_items SET label_en = 'About Vaca Maxi', url_en = '/en/about' WHERE id = 3;
UPDATE menu_items SET label_en = 'Development Scale', url_en = '/en/about-scale' WHERE id = 4;
UPDATE menu_items SET label_en = 'Products', url_en = '/en/products' WHERE id = 5;
UPDATE menu_items SET label_en = 'Wine', url_en = '/en/products/wine' WHERE id = 6;
UPDATE menu_items SET label_en = 'Beef', url_en = '/en/products/beef' WHERE id = 7;
UPDATE menu_items SET label_en = 'Restaurant', url_en = '/en/restaurant' WHERE id = 8;
UPDATE menu_items SET label_en = 'News', url_en = '/en/news' WHERE id = 9;
UPDATE menu_items SET label_en = 'Contact', url_en = '/en/contact' WHERE id = 10;
UPDATE menu_items SET label_en = 'Vacamaxi Cattle Breeds', url_en = '/en/products/breeds' WHERE id = 11;

-- Update Categories with English Translations
UPDATE categories SET name_en = 'Wine' WHERE id = 1;
UPDATE categories SET name_en = 'Cattle' WHERE id = 2;
UPDATE categories SET name_en = 'Beef' WHERE id = 7;
UPDATE categories SET name_en = 'Agriculture', description_en = 'Latest News – Insights From Sustainable Agriculture To Modern Restaurants, Connecting Culinary Culture And Wine Trends Shaping The Market' WHERE id = 9;
UPDATE categories SET name_en = 'Food & Beverage Industry', description_en = 'Latest News – Insights From Sustainable Agriculture To Modern Restaurants, Connecting Culinary Culture And Wine Trends Shaping The Market' WHERE id = 10;
UPDATE categories SET name_en = 'Cuisine & Steak' WHERE id = 11;
UPDATE categories SET name_en = 'Farming Experience' WHERE id = 12;
UPDATE categories SET name_en = 'Vaca Maxi News' WHERE id = 13;

-- Update Experts with English Translations
UPDATE experts SET role_en = 'Vaca Maxi Project Director', description_en = 'President of the National Scientific and Technical Research Council\nDirector of the Animal Biotechnology Laboratory at the Faculty of Agronomy, University of Buenos Aires\nRenowned for pioneering contributions to animal cloning and biotechnology.\nPhD in Biotechnology & Biomedicine from the University of Massachusetts (USA).' WHERE id = 9;
UPDATE experts SET role_en = 'Project Scientist & Veterinarian', description_en = 'Leading expert in in-vitro embryo production, including cloning, IVF, ICSI, and related technologies.\nPlayed a key role in producing Argentina\'s first transgenic animals for xenotransplantation.\nCollaborated with Dr. Daniel Salamone to produce Argentina\'s first cloned cows and horses, marking a milestone in animal biotechnology.' WHERE id = 10;
UPDATE experts SET role_en = 'Animal Reproduction Expert', description_en = 'Expert in animal reproduction with extensive experience in embryo transfer, estrus synchronization, and ovum pick-up (OPU).\nWorked for many years with Dr. Carlos Munar at Argentina\'s largest cattle reproduction firm, participating in groundbreaking research and commercial projects.' WHERE id = 11;
UPDATE experts SET role_en = 'Biologist & Embryologist', description_en = 'Expert in IVF and molecular biology.\nPioneered the creation of Argentina\'s first tetraploid cattle embryos, opening new research avenues with conservation and commercial applications.' WHERE id = 12;
UPDATE experts SET role_en = 'Veterinarian', description_en = 'Lecturer at the Faculty of Veterinary Sciences, University of Buenos Aires (UBA), specializing in cattle health and animal reproduction.\nConducted embryo transfer projects in cattle and camelids with Dr. Miragaya, presenting research at prestigious international scientific conferences.' WHERE id = 13;
UPDATE experts SET role_en = 'Veterinarian & Nutrition Specialist', description_en = 'Leading expert in animal nutrition and meat quality.\nWorked in the Department of Animal Nutrition, UBA with Dr. Verónica De Luca, teaching courses on cattle nutrition and leading the renowned "Meat Sommelier" training program at the University of Buenos Aires.' WHERE id = 14;
UPDATE experts SET role_en = 'Veterinarian', description_en = 'Expert in animal health, livestock production, and cattle management.\nCurrently director of the veterinary hospital at the University of Buenos Aires, balancing academia with strategic consulting for major livestock enterprises.' WHERE id = 15;

-- Update Frontend Widgets with English Translations
UPDATE frontend_widgets SET 
    title_en = 'VACAMAXI is a premium steak & grill restaurant', 
    sub_title_en = '5-star Restaurant VACAMAXI', 
    description_en = 'Where cuisine is not only tasted by palate, but also felt through aesthetics, space, and the depth of the story behind each choice.',
    settings_en = '{"slides":[{"title":"VACAMAXI is a premium steak & grill restaurant","sub_title":"5-star Restaurant VACAMAXI","description":"Where cuisine is not only tasted by palate, but also felt through aesthetics, space, and the depth of the story behind each choice.","button_text":"DISCOVER NOW","button_url":"#about","image":"\\/image\\/banner.png"},{"title":"High-tech farming ecosystem","sub_title":"Pioneer in Vietnam","description":"Cooperating with leading Argentine experts, we develop cattle breeds and high-quality beef according to international standards.","button_text":"VIEW PRODUCTS","button_url":"\\/en\\/products","image":"\\/image\\/Rectangle 11.png"},{"title":"Sustainable agriculture essence","sub_title":"VACAMAXI Group","description":"Bringing sustainable value and luxury experience through each product from farm to table.","button_text":"CONTACT NOW","button_url":"\\/en\\/contact","image":"\\/image\\/Rectangle 5.png"},{"title":"5-star luxury dining service","sub_title":"Premium Experience","description":"Elegant space and professional staff, bringing you the most perfect steak feast.","button_text":"BOOK A TABLE","button_url":"#contact","image":"\\/image\\/Rectangle 2.png"},{"title":"Quality from origin","sub_title":"Clean & Safe","description":"Each product undergoes strict control processes, ensuring freshness and optimal nutrition for health.","button_text":"LEARN MORE","button_url":"\\/en\\/about","image":"\\/image\\/Rectangle 3.png"}]}'
WHERE id = 1;

UPDATE frontend_widgets SET 
    title_en = 'ABOUT VACAMAXI', 
    description_en = 'VACAMAXI pioneers the creation of high-tech livestock ecosystems in Vietnam. Partnering with leading experts from Argentina, we develop cattle breeding and high-quality beef in accordance with international standards. Expanding the value chain with premium wine and selected restaurants, VACAMAXI delivers sustainable value and class experiences.',
    settings_en = '{"button_text":"Learn more","button_url":"\\/en\\/about"}'
WHERE id = 2;

UPDATE frontend_widgets SET 
    title_en = 'VACAMAXI CATTLE BREEDS', 
    sub_title_en = 'OUR CATTLE BREEDS', 
    description_en = 'Each cattle breed at VACAMAXI is the result of strict selection and genetic development, ensuring outstanding productivity and quality.',
    settings_en = '{"button_text":"SEE MORE","button_url":"\\/en\\/products","highlight":"VACAMAXI"}'
WHERE id = 3;

UPDATE frontend_widgets SET 
    title_en = 'VACAMAXI EXPERT TEAM', 
    sub_title_en = 'Cooperation between VACAMAXI and Argentine experts', 
    description_en = 'The livestock production system is designed and implemented by the world\'s leading expert team. Experts with expertise in animal nutrition, cattle health, and meat quality monitor the entire process.',
    settings_en = '{"button_text":"Learn more","button_url":"\\/en\\/about"}'
WHERE id = 4;

UPDATE frontend_widgets SET 
    title_en = 'VACAMAXI BEEF', 
    sub_title_en = 'BEEF PRODUCTS', 
    description_en = 'Each beef product at VACAMAXI is processed under strict standards to guarantee tenderness and taste.',
    settings_en = '{"button_text":"SEE MORE","button_url":"\\/en\\/products","highlight":"VACAMAXI"}'
WHERE id = 5;

UPDATE frontend_widgets SET 
    title_en = 'VACAMAXI WINE', 
    sub_title_en = 'AGRICULTURAL ESSENCE', 
    description_en = 'Traditional wines developed by VACAMAXI, brewed from grains familiar to Vietnamese people.',
    settings_en = '{"button_text":"SEE MORE","button_url":"\\/en\\/products","highlight":"VACAMAXI"}'
WHERE id = 6;

UPDATE frontend_widgets SET 
    title_en = '5-STAR RESTAURANT VACAMAXI', 
    description_en = 'Where cuisine is not only tasted by palate, but also felt through aesthetics, space, and the depth of the story behind each choice.',
    settings_en = '{"button_text":"SEE MORE","button_url":"\\/en\\/products"}'
WHERE id = 7;

UPDATE frontend_widgets SET 
    title_en = 'CUSTOMER REVIEWS', 
    sub_title_en = 'on Google Maps', 
    description_en = 'Real sharing from customers after experiencing VACAMAXI.',
    settings_en = '{"items":[{"avatar":"\\/image\\/Rectangle 2.png","role":"Customer","name":"Hoang Trang","content":"VACAMAXI beef is truly high-quality. Tender, fresh and very well-seasoned."},{"avatar":"\\/image\\/Rectangle 3.png","role":"Customer","name":"Tung Phan","content":"Perfect place for steak lovers. Beautiful space, friendly staff, helpful suggestions."},{"avatar":"\\/image\\/Rectangle 4.png","role":"Customer","name":"Minh Anh","content":"Meticulously prepared dishes, wine pairing is wonderful, space is perfect for family dinner."},{"avatar":"\\/image\\/Rectangle 5.png","role":"Customer","name":"Quoc Huy","content":"Perfect grilled steak, sweet meat, fast service. Very worth returning."},{"avatar":"\\/image\\/Rectangle 2.png","role":"Customer","name":"Thanh Mai","content":"I love the way they recommend the cut. Consistent quality."},{"avatar":"\\/image\\/Rectangle 3.png","role":"Customer","name":"Duc Nam","content":"Restaurant has good beef quality, cooking temperature is exact, cozy layout."},{"avatar":"\\/image\\/Rectangle 4.png","role":"Customer","name":"Lan Phuong","content":"The suggested Ginseng Wine 369 paired very well. A must try for steak lovers."},{"avatar":"\\/image\\/Rectangle 5.png","role":"Customer","name":"Gia Bao","content":"Highly appreciate ingredients and service. Neat and professional."},{"avatar":"\\/image\\/Rectangle 2.png","role":"Customer","name":"Kim Ngan","content":"Warm space, food served at good pace, trustworthy beef quality."},{"avatar":"\\/image\\/Rectangle 3.png","role":"Customer","name":"Anh Tuan","content":"Tried many times and quality is consistent. Good steak, polite service."}]}'
WHERE id = 8;

UPDATE frontend_widgets SET 
    title_en = 'PERSPECTIVES & TRENDS', 
    sub_title_en = 'LATEST NEWS', 
    description_en = 'Latest news - perspectives from sustainable agriculture to modern restaurants, connecting culinary culture and wine trends shaping the market.',
    settings_en = '{"button_text":"SEE MORE","button_url":"\\/en\\/news","highlight":"TRENDS"}'
WHERE id = 9;

UPDATE frontend_widgets SET 
    title_en = 'INTRODUCTION', 
    sub_title_en = 'ABOUT VACAMAXI', 
    description_en = 'VACAMAXI was born with the aspiration to change the landscape of the Vietnamese livestock industry. In the context of consumers demanding high-quality beef, the domestic livestock industry still has many limitations in terms of breeds, processes, and productivity. VACAMAXI appears as a symbol of technological innovation and global knowledge transfer, laying the foundation for a modern and sustainable livestock ecosystem.',
    settings_en = '[]'
WHERE id = 10;

UPDATE frontend_widgets SET 
    title_en = 'VACAMAXI', 
    sub_title_en = 'From embryo to meat - Every step is cared for by science and dedication.', 
    description_en = 'Vision to 2035: Become Asia\'s leading brand in breeding cows, beef, high-tech farming and value-added agricultural products.|Mission: Pioneering the application of biotechnology to innovate Vietnam\'s beef cattle industry, providing clean, high-quality and sustainable products.',
    settings_en = '{"button_text":"Learn more","button_url":"\\/en\\/about"}'
WHERE id = 11;

UPDATE frontend_widgets SET 
    title_en = 'Core Values', 
    description_en = 'Pioneering technology: Applying modern technology in the entire production chain to control from origin to final product.|Quality commitment: Complying with strict standards to ensure each product is always stable and safe.|Sustainable development: Combining economic efficiency with environmental and community responsibility.|Comprehensive cooperation: Linking experts, farmers and businesses to raise the agricultural ecosystem.|Reputable transparency: Building trust with data, processes and clear quality verification.',
    settings_en = '{"image_en":"\\/image\\/GIÁ TRỊ CỐT LÕI-01 1_en.png"}'
WHERE id = 12;

UPDATE frontend_widgets SET 
    title_en = 'VACAMAXI Expert Team', 
    description_en = 'Cooperation between VACAMAXI and Argentine experts helps the production system run in accordance with international standards, from nutrition, herd health to meat quality control.|The expert team not only advises but also directly transfers techniques, trains personnel and standardizes processes to improve local capacity.',
    settings_en = '[]'
WHERE id = 13;

UPDATE frontend_widgets SET 
    title_en = 'Farm Model', 
    description_en = 'VACAMAXI farm in Tan Linh, Ba Vi, Hanoi is planned according to a closed and fully autonomous model, connecting links from breeding, feed, care to distribution.|This model helps ensure natural green feed sources, increase quality control and optimize long-term operational efficiency.',
    settings_en = '[]'
WHERE id = 14;

UPDATE frontend_widgets SET 
    title_en = 'Explore development scale', 
    description_en = 'View details of VACAMAXI\'s chain operating capacity from farm, factory to distribution system.',
    settings_en = '{"button_text":"View scale page","button_url":"\\/en\\/about-scale"}'
WHERE id = 15;

UPDATE frontend_widgets SET 
    title_en = 'SCALE - TECHNOLOGY', 
    sub_title_en = 'CLOSED FARM MODEL', 
    description_en = 'Closed - synchronized - modern farm model|VACAMAXI farm located in Tan Linh, Ba Vi, Hanoi, is planned on an area of 39 ha, according to a closed and fully autonomous model.|The system includes:|– Standard barns – Separate feed processing workshop|– High-tech embryo production center – Office area, yard, ecological landscape area|– Grass growing area – ensuring natural green food sources',
    settings_en = '[]'
WHERE id = 16;

UPDATE frontend_widgets SET 
    title_en = 'Farm Model', 
    description_en = 'The farm is well-invested, ensuring closed operations from breeding - feed - care - environmental treatment - product distribution.|The system is designed and operated under the supervision of an expert team, combining biotechnology with field experience to improve cow herd productivity and control uniform quality.',
    settings_en = '[]'
WHERE id = 17;

UPDATE frontend_widgets SET 
    title_en = 'VACAMAXI Expert Team', 
    description_en = 'Dr. Daniel Salamone|Tiến sĩ Rajneesh Verma|Dr. Federico Allegroni|Dr. Nicholas Farnetano|Dr. Verónica Gorleri|Dr. Juan Manuel Álvarez|Dr. Martín Romeo|Dr. Victoria Amusquibar',
    settings_en = '[]'
WHERE id = 18;

UPDATE frontend_widgets SET 
    title_en = 'Specialized care and nutrition regime', 
    description_en = 'Each individual cow at VACAMAXI is cared for under a separate regime, depending on the stage of development. Feed is produced on site, controlling the mixing formula and nutrition.|The automated health monitoring process helps minimize risks, increase herd uniformity and maintain high standard meat quality.',
    settings_en = '[]'
WHERE id = 19;

UPDATE frontend_widgets SET 
    title_en = 'Biotechnology', 
    description_en = 'VACAMAXI pioneers the application of biotechnology in the entire breeding and livestock development process nationwide.|Our platform is a combination of genetic data, IVF techniques and high-standard herd management, helping to optimize success rates and breeding quality.',
    settings_en = '[]'
WHERE id = 20;

UPDATE frontend_widgets SET 
    title_en = 'Why did we choose IVF?', 
    description_en = 'IVF requires large investments in equipment, human resources and high technical processes, but this is the necessary way to create a uniform - healthy - high performance cow herd, serving the closed breeding, processing and commercial chain.',
    settings_en = '[]'
WHERE id = 21;

UPDATE frontend_widgets SET 
    title_en = 'Development strategy from sex-selected embryo breeds', 
    description_en = 'Embryo transfer into base cows to create breeding cows: Developing a female cow herd with high genetic quality to increase high quality calf production and create a stable long-term breeding source for the system.|Embryo transfer into cows to develop premium beef: Creating a fast-growing male cow herd with high meat ratio, suitable for meat production models and expanding supply for premium beef segment.',
    settings_en = '[]'
WHERE id = 22;

UPDATE frontend_widgets SET 
    title_en = 'Learn more about VACAMAXI', 
    description_en = 'Go back to the introduction page to see our vision, mission and core values overview.',
    settings_en = '{"button_text":"Back to intro page","button_url":"\\/en\\/about"}'
WHERE id = 23;

UPDATE frontend_widgets SET 
    title_en = 'Service - Restaurant', 
    sub_title_en = 'Home / Restaurant Service', 
    description_en = 'Premium steak & grill space of VACA MAXI.',
    settings_en = '{"images":["\\/image\\/banner.png"]}'
WHERE id = 24;

UPDATE frontend_widgets SET 
    title_en = 'Vaca Maxi Restaurant', 
    description_en = 'VACA MAXI is a premium steak & grill restaurant where cuisine is not only tasted by palate, but also felt through aesthetics, space, and the depth of the story behind each choice. The restaurant was formed from a different mindset about dining experience: a truly complete meal when the ingredients have a foundation, the wine is aged and the space is delicate enough for all emotions to be guided naturally.',
    settings_en = '{"button_text":"Learn more","button_url":"#restaurant-banner"}'
WHERE id = 25;

UPDATE frontend_widgets SET 
    title_en = 'VACA MAXI is a premium steak & grill restaurant', 
    sub_title_en = '5-star Restaurant Vaca Maxi', 
    description_en = 'Where cuisine is not only tasted by palate, but also felt through aesthetics, space, and the depth of the story behind each choice.',
    settings_en = '{"button_text":"Discover now","button_url":"#restaurant-products"}'
WHERE id = 26;

UPDATE frontend_widgets SET 
    title_en = '5-star Restaurant Vaca Maxi', 
    description_en = 'Where cuisine is not only tasted by palate, but also felt through aesthetics, space, and the depth of the story behind each choice.',
    settings_en = '[]'
WHERE id = 27;

UPDATE frontend_widgets SET 
    title_en = 'Vaca Maxi Wine', 
    description_en = 'Latest wine products at VACA MAXI.',
    settings_en = '{"button_text":"See more","button_url":"\\/en\\/products\\/ruou"}'
WHERE id = 28;

UPDATE frontend_widgets SET 
    title_en = 'Vaca Maxi Beef', 
    description_en = 'Latest beef products at VACA MAXI.',
    settings_en = '{"button_text":"See more","button_url":"\\/en\\/products\\/thit-bo"}'
WHERE id = 29;

UPDATE posts SET 
    title_en = 'About VACA MAXI', 
    description_en = 'Article about the Mission, Objectives, and Benefits of the VACA MAXI project.',
    content_en = '<h2><strong>Project Mission</strong></h2><p>&nbsp;</p><p>Breeding research plans to create 7 HIGH-QUALITY BEEF CATTLE BREEDS - suitable for the climate of Vietnamese regions. Creating cattle breeds that can withstand ambient temperatures of 0 - 45 °C and weigh 800kg - 1,300kg depending on the breed.</p><p><br>1. Vaca-A &nbsp; &nbsp; 2. Vaca-B &nbsp; &nbsp; 3. Vaca-G</p><p>4. Vaca-S &nbsp; &nbsp; 5. Vaca-N &nbsp; &nbsp; 6. Vaca-F</p><p>7. Vaca-H</p><figure class="image"><img style="aspect-ratio:1047/731;" src="/storage/posts/editor/picture2-20260506015612-xlkmmj.png" width="1047" height="731"></figure><p><br>Feed production provides feed to the market to improve economic efficiency for the livestock industry.</p><p>Processing clean, high-quality beef for the Vietnamese and International markets.</p><h2><br><strong>Project Objectives</strong></h2><figure class="image"><img style="aspect-ratio:739/492;" src="/storage/posts/editor/picture4-20260506015643-dpxy2f.jpg" width="739" height="492"></figure><p><br>• <i>Provide high-quality embryo breeds, meeting domestic consumer and export demands</i>.<br>• <i>PROVIDE feed production processes, optimizing production and saving resources.</i></p><p>• <i>Improve livestock productivity.</i></p><p>• <i>Integrate with other agricultural sectors.</i><br>• <i>Put Vietnam on the world map of high-quality beef production.</i></p><p>• <i>Promote livestock industry.</i></p><p>• <i>Increase agricultural GDP and international competitiveness.</i></p><h2><br><strong>Project Benefits</strong></h2><figure class="image"><img style="aspect-ratio:817/913;" src="/storage/posts/editor/picture5-20260506015817-xqgxgk.png" width="817" height="913"></figure><p>• Create direct &amp; indirect job opportunities in the field of:</p><p>&nbsp; &nbsp;• Livestock</p><p>&nbsp; &nbsp;• Feed production</p><p>&nbsp; &nbsp;• Distribution.</p><p>• Provide high-quality meat sources, meeting domestic and export consumer demands.</p><p>• Innovate processes, optimize production and save resources.</p><p>• Improve livestock productivity.</p><p>• Integrate with other agricultural sectors.</p><p>• Minimize environmental pollution.</p><p>• Use resources efficiently.</p><p>• Preserve precious gene sources.</p>'
WHERE id = 24;

-- Update Products with English Translations
UPDATE products SET 
    name_en = 'Ginseng Wine 369', 
    short_description_en = 'Ginseng wine line developed by VACA MAXI from grains familiar to Vietnamese.',
    description_en = 'Ginseng wine line developed by VACA MAXI from grains familiar to Vietnamese. No industrial alcohol. No artificial flavorings - sweeteners. Regularly tested according to food safety standards.',
    seo_title_en = 'Ginseng Wine 369 - 750ml | VACA MAXI',
    seo_description_en = 'Ginseng wine line developed by VACA MAXI from grains familiar to Vietnamese.'
WHERE id = 1;

UPDATE products SET 
    name_en = 'Tam Coc White Wine', 
    short_description_en = 'Traditional white wine, smooth aftertaste and suitable for Vietnamese cuisine.',
    description_en = 'Traditional white wine, smooth aftertaste and suitable for Vietnamese cuisine. No industrial alcohol. No artificial flavorings - sweeteners. Regularly tested according to food safety standards.',
    seo_title_en = 'Tam Coc White Wine | VACA MAXI',
    seo_description_en = 'Traditional white wine, smooth aftertaste and suitable for Vietnamese cuisine.'
WHERE id = 2;

UPDATE products SET 
    name_en = 'VACA BREED - A', 
    short_description_en = 'Bred from Angus base cattle.',
    description_en = 'High feed conversion rate: Angus cattle are able to convert feed to high-quality beef efficiently.\nExcellent fertility and mothering characteristics: Strong reproductive performance and excellent maternal instinct.\nClimatic adaptation: Performs well in varied environments, from temperate to harsh.\nHigh market demand: One of the most sought after beef cattle breeds in the world.'
WHERE id = 21;

UPDATE products SET 
    name_en = 'VACA BREED - B', 
    short_description_en = 'Bred from Brangus base cattle.',
    description_en = 'Hybrid vigor: Crossbreeding between Angus and Brahman combines the best traits of both breeds.\nHeat tolerance and disease resistance: Brahman influence increases tolerance to hot climate and parasite resistance.\nGrowth performance: Faster growth and improved feed conversion rate.\nDurability: Adapts well to both wet and dry conditions.'
WHERE id = 22;

UPDATE products SET 
    name_en = 'VACA BREED - G', 
    short_description_en = 'Bred from Wagyu base cattle.',
    description_en = 'Genetic superiority: Stands out for its ability to accumulate and distribute marbling evenly, creating irreplaceable tenderness, juiciness and flavor.\nLongevity & Productivity: Longer feeding periods allow meat to develop high quality, while maintaining stable production efficiency.\nStress resistance: Calm temperament, less stress during breeding and transport.\nInternational market appeal: Highly valued in premium markets.'
WHERE id = 23;

UPDATE products SET 
    name_en = 'VACA BREED - S', 
    short_description_en = 'Bred from San Ignacio base cattle.',
    description_en = 'A cattle breed researched for over 10 years and newly launched on the market, bred from 4 different foundation breeds bringing outstanding genes, suitable for all weather conditions.\nGenetic superiority: Crossbreeding between 4 foundation breeds brings high efficiency in both meat and breeding.\nLongevity & Productivity: Large weight, fast growth helps improve meat yield.\nHeat tolerance and disease resistance: African cattle breed influence helps increase tolerance and outstanding parasite resistance.'
WHERE id = 24;

UPDATE products SET 
    name_en = 'VACA BREED - F', 
    short_description_en = 'Bred from Braford base cattle.',
    description_en = 'Genetic superiority: Cross between Hereford and Brahman, combining quality beef capacity with outstanding tropical resistance.\nMeat quality: Tender meat, rich flavor, and medium marbling.\nYield and efficiency: Good weight gain, stable dressing percentage.\nAdaptability: Adapts well to hot and humid climates.'
WHERE id = 25;

UPDATE products SET 
    name_en = 'VACA BREED - N', 
    short_description_en = 'Bred from Nelore base cattle.',
    description_en = 'Nelore cattle are characterized by their bright white coat and distinct large hump on their shoulders, originally originating from Ongole cattle brought to Brazil from India. Nelore is the main beef breed in Brazil.\nAdaptability: Excellent heat and humidity tolerance, well-suited for tropical environments.\nMeat yield: High beef yield, good weight gain.\nDisease resistance: Thick skin, well-developed sweat glands and tropical genetics.'
WHERE id = 26;

UPDATE products SET 
    name_en = 'VACA BREED - H', 
    short_description_en = 'Bred and conserved from H’Mong base cattle.',
    description_en = 'Bred and conserved from H’Mong base cattle.'
WHERE id = 27;

UPDATE products SET 
    name_en = 'VACA-G', 
    description_en = 'Superior marbling: Thick and evenly distributed marbling, creating juiciness and enhancing flavor.\nExceptional tenderness: Extremely fine muscle fiber structure, giving a melt-in-mouth feel.\nFat composition: Higher omega-3 and omega-6 content compared to other beef.'
WHERE id = 28;

UPDATE products SET 
    name_en = 'VACA-B', 
    description_en = 'Balanced lean-to-fat ratio: Brangus beef achieves harmony between high lean meat ratio and beautiful marbling, bringing full flavor but not too greasy.\nJuiciness & flavor: Brahman gene increases juiciness while retaining the distinct flavor of Angus.\nHigh meat ratio: High usable meat ratio, good commercial yield suitable for large-scale production.'
WHERE id = 29;

UPDATE products SET 
    name_en = 'VACA-A', 
    description_en = 'Marbling & flavor: Outstanding with high marbling, making beef tender, juicy and rich in flavor.\nStability and quality: Consistent meat quality between batches, easy to control in commercial production.\nPopularity: Widely favored globally, especially in the premium steak and restaurant segment.'
WHERE id = 30;

UPDATE products SET 
    name_en = 'VACA-F', 
    description_en = 'Flavor: Rich taste, characteristic of grass-fed cattle, easily suited to diverse market tastes.\nTenderness & texture: Braford beef has moderate tenderness, balanced texture, suitable for many cooking methods.\nQuality consistency: Relatively uniform meat quality thanks to hybrid genetic foundation.'
WHERE id = 31;

UPDATE products SET 
    name_en = 'VACA-I', 
    description_en = 'Lean but marbled: Balance between lean muscle and fat for juicy beef.\nJuiciness & flavor: Crossbreeding from 4 foundation stocks gives the beef a distinct aroma.\nHigh meat yield: Provides more usable beef due to growth and large body weight.'
WHERE id = 32;

UPDATE products SET 
    name_en = 'VACA-H', 
    description_en = 'Specialty of H’Mong ethnic people in the Northern mountainous provinces: Fresh red meat, tender, delicious, naturally sweet taste.\nNaturally raised in high lands: Cattle are fed fresh grass, medicinal plants and drink clean stream water, no growth feed or hormones.'
WHERE id = 33;

UPDATE products SET 
    name_en = 'VACA-N', 
    description_en = 'Texture and flavor: Nelore beef is firm, naturally rich in flavor, accounts for most of Brazil\'s supply.\nMeat yield: Stable dressing percentage (about 52–58%) and high lean content.\nMarketability: Nelore beef is suitable for the general consumer segment.'
WHERE id = 34;

-- Update Site Settings with English Translations
UPDATE site_settings SET 
    site_name_en = 'VACA MAXI',
    site_title_en = 'VACA MAXI',
    site_description_en = 'VACAMAXI was born with the aspiration to change the landscape of the Vietnamese livestock industry. In the context of consumers demanding high-quality beef, the domestic livestock industry still has many limitations in terms of breeds, processes, and productivity.',
    seo_title_en = 'VACA MAXI',
    seo_description_en = 'VACAMAXI was born with the aspiration to change the landscape of the Vietnamese livestock industry. In the context of consumers demanding high-quality beef, the domestic livestock industry still has many limitations in terms of breeds, processes, and productivity.',
    seo_keywords_en = 'vaca maxi, vacamaxi, beef, wine, restaurant, steak grill',
    address_en = '166 Pham Van Dong Street, Dong Ngac Ward, Hanoi City'
WHERE id = 1;

-- Add slug_en columns to tables
ALTER TABLE categories ADD COLUMN slug_en VARCHAR(255) NULL AFTER slug;
ALTER TABLE products ADD COLUMN slug_en VARCHAR(255) NULL AFTER slug;
ALTER TABLE posts ADD COLUMN slug_en VARCHAR(255) NULL AFTER slug;

-- Update categories slug_en
UPDATE categories SET slug_en = 'wine' WHERE id = 1;
UPDATE categories SET slug_en = 'cattle' WHERE id = 2;
UPDATE categories SET slug_en = 'beef' WHERE id = 7;
UPDATE categories SET slug_en = 'agriculture' WHERE id = 9;
UPDATE categories SET slug_en = 'food-beverage' WHERE id = 10;
UPDATE categories SET slug_en = 'cuisine-steak' WHERE id = 11;
UPDATE categories SET slug_en = 'husbandry-experience' WHERE id = 12;
UPDATE categories SET slug_en = 'vacamaxi-news' WHERE id = 13;

-- Update products slug_en
UPDATE products SET slug_en = 'ginseng-wine-369' WHERE id = 1;
UPDATE products SET slug_en = 'tam-coc-white-wine' WHERE id = 2;
UPDATE products SET slug_en = 'vaca-breed-a' WHERE id = 21;
UPDATE products SET slug_en = 'vaca-breed-b' WHERE id = 22;
UPDATE products SET slug_en = 'vaca-breed-g' WHERE id = 23;
UPDATE products SET slug_en = 'vaca-breed-s' WHERE id = 24;
UPDATE products SET slug_en = 'vaca-breed-f' WHERE id = 25;
UPDATE products SET slug_en = 'vaca-breed-n' WHERE id = 26;
UPDATE products SET slug_en = 'vaca-breed-h' WHERE id = 27;
UPDATE products SET slug_en = 'vaca-g' WHERE id = 28;
UPDATE products SET slug_en = 'vaca-b' WHERE id = 29;
UPDATE products SET slug_en = 'vaca-a' WHERE id = 30;
UPDATE products SET slug_en = 'vaca-f' WHERE id = 31;
UPDATE products SET slug_en = 'vaca-i' WHERE id = 32;
UPDATE products SET slug_en = 'vaca-h' WHERE id = 33;
UPDATE products SET slug_en = 'vaca-n' WHERE id = 34;

-- Update posts slug_en
UPDATE posts SET slug_en = 'tam-coc-white-wine' WHERE id = 23;
UPDATE posts SET slug_en = 'about-vaca-maxi' WHERE id = 24;

