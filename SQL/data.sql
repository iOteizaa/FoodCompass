-- Insert tipos de comida
INSERT INTO tipos_comida (id, nombre) VALUES 
(1, 'Andaluz'),
(2, 'Argentino'),
(3, 'Hamburguesas'),
(4, 'Internacional'),
(5, 'Italiano'),
(6, 'Japonés'),
(7, 'Mediterráneo'),
(8, 'Mexicano'),
(9, 'Peruano'),
(10, 'Tapas'),
(11, 'Vietnamita'),
(12, 'Español');

-- Insert de 5 restaurantes
INSERT INTO restaurantes (id, nombre, precio, valoraciones, ubicacion, descripcion, latitud, longitud, imagenes) VALUES
(1, 'La Ristobottega', 25, 9.2, 'C. Cañón, 3, Distrito Centro, Málaga', 'Auténtica trattoria italiana en el corazón de Málaga, famosa por su pasta fresca, ingredientes importados y un ambiente acogedor que te transporta a Italia.', 36.72171, -4.42140, '[
  "https://media-cdn.tripadvisor.com/media/photo-s/29/63/fb/6d/outside-restaurant.jpg",
  "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1d/ac/89/93/barra.jpg?w=900&h=500&s=1",
  "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/97/b2/fc/caption.jpg?w=1000&h=-1&s=1",
  "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/94/55/0a/caption.jpg?w=1000&h=-1&s=1",
  "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/93/8b/87/caption.jpg?w=1000&h=-1&s=1",
  "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/8c/3f/23/caption.jpg?w=1000&h=-1&s=1"
]'),

(2, 'Palodú', 90, 9.5, 'C. Sebastián Souvirón, 7-9, 29005 Málaga', 'Palodú ofrece un nuevo concepto. Acercamos la alta cocina creando, con los mejores ingredientes, una cocina de autor...', 36.72195, -4.42866, '[
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/e0a2b615-fc62-4c99-9b0e-b1864f4e8e95/05851d57-47fa-4d1b-8318-b662734bcac8.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/e0a2b615-fc62-4c99-9b0e-b1864f4e8e95/771ceabc-cac1-4480-b4e1-5df907477fb8.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/e0a2b615-fc62-4c99-9b0e-b1864f4e8e95/d360b59b-ad0a-42c1-978f-e61b17aa3dc8.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/f_auto,q_auto,w_800,c_limit/customer/e0a2b615-fc62-4c99-9b0e-b1864f4e8e95/ff764bd1-eb56-4c25-ba01-3609e1211076.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/f_auto,q_auto,w_800,c_limit/customer/e0a2b615-fc62-4c99-9b0e-b1864f4e8e95/b8a5be5f-1b0f-40ce-88a3-2c37c872b128.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/f_auto,q_auto,w_800,c_limit/customer/e0a2b615-fc62-4c99-9b0e-b1864f4e8e95/56f33c96-2711-4542-80a2-82fc094477b6.jpg"
]'),

(3, 'La Antxoeta Art', 45, 9.7, 'Calle Barroso 7, 29001 Málaga', 'La Antxoeta Art ofrece una experiencia gastronómica única en un ambiente íntimo y decorado con obras de arte...', 36.72090, -4.42519, '[
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/9ed9aeb4-6c08-472e-8637-32bcf418377f/5289ea51-4d6e-4e5a-ab36-40e8c8998a73.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/9ed9aeb4-6c08-472e-8637-32bcf418377f/378e6f4b-029a-4560-a87e-a55b589a3ef8.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/9ed9aeb4-6c08-472e-8637-32bcf418377f/5c2485d3-811b-44f8-b03a-c98e0df19876.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/9ed9aeb4-6c08-472e-8637-32bcf418377f/731cb32c-1d36-4d89-b271-cde030cd1d88.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/9ed9aeb4-6c08-472e-8637-32bcf418377f/aca8a706-fb31-4035-93cb-5b788bd00ce6.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/f_auto,q_auto,w_800,c_limit/customer/9ed9aeb4-6c08-472e-8637-32bcf418377f/c32b4de2-16bf-4369-a508-0766ba424d1f.jpg"
]'),

(4, 'Miss Sushi Málaga Soho', 25, 8.7, 'C. Córdoba, 6, 29001 Málaga', 'Miss Sushi Málaga Soho ofrece un ambiente acogedor y una bonita decoración...', 36.71599, -4.42641, '[
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/565dfac1-136a-48bf-bf12-a302f21ae6d3/ce5427cb-cb52-4ae0-b2fa-69df48680b4d.png",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/565dfac1-136a-48bf-bf12-a302f21ae6d3/22fb15cd-7f6f-4d82-80fb-6eb100d4f521.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/565dfac1-136a-48bf-bf12-a302f21ae6d3/8f70f352-bec0-4841-a517-a22f7d2cce15.png",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/565dfac1-136a-48bf-bf12-a302f21ae6d3/dee4c06f-dbe3-4d2f-a446-446f3feb72ed.png",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/f_auto,q_auto,w_800,c_limit/customer/565dfac1-136a-48bf-bf12-a302f21ae6d3/f4ca0ade-26a8-4b31-b3a2-899628dbcfee.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/f_auto,q_auto,w_800,c_limit/customer/565dfac1-136a-48bf-bf12-a302f21ae6d3/70309b9d-3976-4e62-b7dd-e12abd750039.jpg"
]'),

(5, 'José, Herencia de Cocina', 20, 9.2, 'C. Medellín, 1, 29002 Málaga', 'José, Herencia de Cocina ofrece un ambiente hermoso y tranquilo...', 36.71397, -4.44162, '[
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/558d553b-37fb-4ad3-912d-09cddf8c8577/6bf6b249-e3eb-4c59-a3f6-786a8fc196b5.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/558d553b-37fb-4ad3-912d-09cddf8c8577/27093058-feca-4de1-a4d5-d65b7294242d.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/558d553b-37fb-4ad3-912d-09cddf8c8577/a9cb6ab1-8713-4cb4-8eee-4b908ecbe55f.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/558d553b-37fb-4ad3-912d-09cddf8c8577/5e61e3d8-7254-460c-ae68-e51098536d56.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/558d553b-37fb-4ad3-912d-09cddf8c8577/fc80350d-4be9-480b-9008-492e23ad52a8.jpg",
  "https://res.cloudinary.com/tf-lab/image/upload/w_640,c_fill,q_auto,f_auto/restaurant/558d553b-37fb-4ad3-912d-09cddf8c8577/f6d315e5-e91c-4380-aa53-93e77b8dd1d9.jpg"
]');

-- Asociar cada restaurante con su tipo de comida
INSERT INTO restaurante_tipo_comida (restaurante_id, tipo_comida_id) VALUES
-- Italiano
(1, 5),
-- Mediterráneo
(2, 7),
-- Mediterráneo
(3, 7),
-- Japonés
(4, 6),
-- Andaluz
(5, 1);

-- Horarios
INSERT INTO horarios_restaurante (restaurante_id, dia_semana, hora_apertura, hora_cierre) VALUES
(1, 'Lunes', '09:30:00', '23:45:00'),
(1, 'Martes', '09:30:00', '23:45:00'),
(1, 'Miércoles', '09:30:00', '23:45:00'),
(1, 'Jueves', '09:30:00', '23:45:00'),
(1, 'Viernes', '09:30:00', '23:45:00'),
(1, 'Sábado', '09:30:00', '23:45:00'),
(1, 'Domingo', '09:30:00', '23:45:00'),

(2, 'Martes', '13:30:00', '15:00:00'),
(2, 'Martes', '20:30:00', '22:00:00'),
(2, 'Miércoles', '13:30:00', '15:00:00'),
(2, 'Miércoles', '20:30:00', '22:00:00'),
(2, 'Jueves', '13:30:00', '15:00:00'),
(2, 'Jueves', '20:30:00', '22:00:00'),
(2, 'Viernes', '13:30:00', '15:00:00'),
(2, 'Viernes', '20:30:00', '22:00:00'),
(2, 'Sábado', '13:30:00', '15:00:00'),
(2, 'Sábado', '20:30:00', '22:00:00'),

(3, 'Martes', '13:30:00', '15:30:00'),
(3, 'Martes', '20:00:00', '21:45:00'),
(3, 'Miércoles', '13:30:00', '15:30:00'),
(3, 'Miércoles', '20:00:00', '21:45:00'),
(3, 'Jueves', '13:30:00', '15:30:00'),
(3, 'Jueves', '20:00:00', '21:45:00'),
(3, 'Viernes', '13:30:00', '15:30:00'),
(3, 'Viernes', '20:00:00', '21:45:00'),
(3, 'Sábado', '13:30:00', '15:30:00'),
(3, 'Sábado', '20:00:00', '21:45:00'),

(4, 'Lunes', '13:15:00', '23:15:00'),
(4, 'Martes', '13:15:00', '23:15:00'),
(4, 'Miércoles', '13:15:00', '23:15:00'),
(4, 'Jueves', '13:15:00', '23:15:00'),
(4, 'Viernes', '13:15:00', '23:15:00'),
(4, 'Sábado', '13:15:00', '23:15:00'),
(4, 'Domingo', '13:15:00', '23:15:00'),

(5, 'Lunes', '13:00:00', '15:45:00'),
(5, 'Lunes', '20:00:00', '00:00:00'),
(5, 'Martes', '13:00:00', '15:45:00'),
(5, 'Martes', '20:00:00', '00:00:00'),
(5, 'Miércoles', '13:00:00', '15:45:00'),
(5, 'Miércoles', '20:00:00', '00:00:00'),
(5, 'Jueves', '13:00:00', '15:45:00'),
(5, 'Jueves', '20:00:00', '00:00:00'),
(5, 'Viernes', '13:00:00', '15:45:00'),
(5, 'Viernes', '20:00:00', '00:00:00'),
(5, 'Sábado', '13:00:00', '15:45:00'),
(5, 'Sábado', '20:00:00', '00:00:00'),
(5, 'Domingo', '13:00:00', '15:45:00'),
(5, 'Domingo', '20:00:00', '00:00:00');