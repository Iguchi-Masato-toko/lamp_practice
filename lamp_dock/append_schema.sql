CREATE TABLE history (
  history_id INT AUTO_INCREMENT,
  user_id INT,
  purchace_date DATETIME,
  primary key(history_id)
);

CREATE TABLE history_item(
  history_id INT,
  item_id INT,
  amount INT,
  price INT
);