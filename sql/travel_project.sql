CREATE DATABASE IF NOT EXISTS travel_project;
USE travel_project;

DROP TABLE IF EXISTS enquiries;
DROP TABLE IF EXISTS destination_images;
DROP TABLE IF EXISTS destinations;

CREATE TABLE destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    description TEXT NOT NULL,
    info TEXT NOT NULL
);

CREATE TABLE destination_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destination_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE
);

CREATE TABLE enquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    message TEXT NOT NULL,
    destination_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE
);



INSERT INTO destinations (name, description, info) VALUES
('India', 'A land of diverse culture and heritage', 'India is known for history, traditions and varied geography.'),
('France', 'Romantic country in Europe', 'France is famous for Eiffel Tower, Louvre, and the Riviera.');
('Japan', 'Land of the rising sun', 'Japan is known for its technology, traditions, and cherry blossoms.'),
('Italy', 'Heart of Roman Empire and Renaissance', 'Italy is famous for Rome, Venice, and Florence.'),
('Australia', 'Continent and country down under', 'Australia is known for Sydney Opera House, Great Barrier Reef, and Outback.'),
('Egypt', 'Land of ancient pharaohs', 'Egypt is famous for Pyramids of Giza, Nile River, and ancient temples.'),
('Brazil', 'Largest country in South America', 'Brazil is famous for Amazon Rainforest, Rio Carnival, and Christ the Redeemer.'),
('USA', 'The United States of America', 'USA is famous for Statue of Liberty, Grand Canyon, and Silicon Valley.'),
('UK', 'United Kingdom of Great Britain', 'UK is famous for London, Stonehenge, and Edinburgh Castle.'),
('China', 'Most populous country in the world', 'China is famous for the Great Wall, Forbidden City, and Terracotta Army.'),
('South Africa', 'Rainbow Nation', 'South Africa is known for Table Mountain, Kruger National Park, and Cape of Good Hope.'),
('Spain', 'Country of flamenco and fiestas', 'Spain is famous for Barcelona, Madrid, and Alhambra Palace.');

-- India
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/india1.jpg' FROM destinations WHERE name = 'India';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/india2.jpg' FROM destinations WHERE name = 'India';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/india3.jpg' FROM destinations WHERE name = 'India';

-- France
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/france1.jpg' FROM destinations WHERE name = 'France';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/france2.jpg' FROM destinations WHERE name = 'France';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/france3.jpg' FROM destinations WHERE name = 'France';

-- Japan
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/japan1.jpg' FROM destinations WHERE name = 'Japan';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/japan2.jpg' FROM destinations WHERE name = 'Japan';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/japan3.jpg' FROM destinations WHERE name = 'Japan';

-- Italy
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/italy1.jpg' FROM destinations WHERE name = 'Italy';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/italy2.jpg' FROM destinations WHERE name = 'Italy';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/italy3.jpg' FROM destinations WHERE name = 'Italy';

-- Australia
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/australia1.jpg' FROM destinations WHERE name = 'Australia';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/australia2.jpg' FROM destinations WHERE name = 'Australia';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/australia3.jpg' FROM destinations WHERE name = 'Australia';

-- Egypt
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/egypt1.jpg' FROM destinations WHERE name = 'Egypt';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/egypt2.jpg' FROM destinations WHERE name = 'Egypt';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/egypt3.jpg' FROM destinations WHERE name = 'Egypt';

-- Brazil
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/brazil1.jpg' FROM destinations WHERE name = 'Brazil';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/brazil2.jpg' FROM destinations WHERE name = 'Brazil';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/brazil3.jpg' FROM destinations WHERE name = 'Brazil';

-- USA
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/usa1.jpg' FROM destinations WHERE name = 'USA';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/usa2.jpg' FROM destinations WHERE name = 'USA';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/usa3.jpg' FROM destinations WHERE name = 'USA';

-- UK
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/uk1.jpg' FROM destinations WHERE name = 'UK';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/uk2.jpg' FROM destinations WHERE name = 'UK';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/uk3.jpg' FROM destinations WHERE name = 'UK';

-- China
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/china1.jpg' FROM destinations WHERE name = 'China';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/china2.jpg' FROM destinations WHERE name = 'China';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/china3.jpg' FROM destinations WHERE name = 'China';

-- South Africa
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/southafrica1.jpg' FROM destinations WHERE name = 'South Africa';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/southafrica2.jpg' FROM destinations WHERE name = 'South Africa';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/southafrica3.jpg' FROM destinations WHERE name = 'South Africa';

-- Spain
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/spain1.jpg' FROM destinations WHERE name = 'Spain';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/spain2.jpg' FROM destinations WHERE name = 'Spain';
INSERT INTO destination_images (destination_id, image_path)
SELECT id, 'images/spain3.jpg' FROM destinations WHERE name = 'Spain';
