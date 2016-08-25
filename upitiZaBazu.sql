Upiti za Bazu

Search upit
- ime grada
- datum dolaska
- datum odlaska
- vrsta sobe

--> pronaci sve hotele u trazenom gradu koji u trazenom periodu imaju slobodnu trazenu sobu
select * from city join hotel
on city.postal_code = hotel.postal_code join room
on hotel.id = room.id_hotel join reservation
on room.id = reservation.id_room
where city.name = 'Zagreb'
and room.type = 'Dvokrevetna';



$query = "SELECT * FROM city join hotel
            ON city.postal_code = hotel.postal_code join room
            ON hotel.id = room.id_hotel left join reservation
            where (room.id not in(select id_room from reservation))
            or
            (room.id in (select id_room from reservation) 
            and !('datum dolaska') >= date_arrival and ('datum odlaska') <= date_departure)"





, room, booking
where $row['city.name'] = 'Zagreb'