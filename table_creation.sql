Create table Route(
Route_id int primary key,
Route_name varchar(100)
);
Create table Customer(
CID int primary key,
Booker_name varchar(100),
Phone_no integer(10)
);

create table Train_details(
Train_id integer primary key,
Train_name varchar(100),
Source_id varchar(100),
Destination_id varchar(100),
num_of_seats_ac integer,
num_of_seats_nonac integer,
ac_price float,
nonac_price float,
Route_id integer,
foreign key(Route_id) references Route(Route_id)
);
create table Train_info(
Schedule_id varchar(100) primary key,
Train_id integer,
Route_id integer,
num_of_seats_ac integer,
num_of_seats_nonac integer,
departure datetime,
arrival datetime,
foreign key(Train_id) references Train_details(Train_id),
foreign key(Route_id) references Route(Route_id)
);


create table Ticket(

Ticket_id integer primary key,
seat_number integer,
Train_id integer,
Passenger_name varchar(50),
Phone_no bigint,
Schedule_id varchar(100),
Price float,
departure datetime,
arrival datetime,
Route_id integer,
class varchar(15),

foreign key(Train_id) references Train_details(Train_id),
foreign key(Schedule_id) references Train_info(Schedule_id),

foreign key(Route_id) references Route(Route_id)
);

