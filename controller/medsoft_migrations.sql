-- Run once if not using auto-create in controller
CREATE TABLE IF NOT EXISTS bills (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  bill_no VARCHAR(64) NOT NULL,
  bill_date DATETIME NOT NULL,
  customer_name VARCHAR(255) NULL,
  contact_number VARCHAR(64) NULL,
  address VARCHAR(255) NULL,
  total_amount DECIMAL(12,2) NOT NULL DEFAULT 0,
  payment_status VARCHAR(32) NOT NULL DEFAULT 'Paid',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX (bill_date),
  INDEX (bill_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS bill_items (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  bill_id INT NOT NULL,
  medicine_id INT NOT NULL,
  batch_id INT NOT NULL,
  medicine_name VARCHAR(255) NOT NULL,
  quantity INT NOT NULL,
  mrp DECIMAL(12,2) NOT NULL,
  discount_percent DECIMAL(5,2) NOT NULL DEFAULT 0,
  line_total DECIMAL(12,2) NOT NULL,
  CONSTRAINT fk_bill_items_bill FOREIGN KEY (bill_id) REFERENCES bills (id) ON DELETE CASCADE,
  INDEX (medicine_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



