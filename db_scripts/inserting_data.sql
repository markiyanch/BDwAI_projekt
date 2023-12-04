-- Insert into 'clients' table
INSERT INTO clients (name, activity_type, address, phone_number) VALUES
('Jan Kowalski', 'Informatyka', 'ul. Kwiatowa, 1', 123456789),
('Anna Nowak', 'Rolnictwo', 'ul. Centralna, 2', 987654321),
('Michał Wiśniewski', 'Handel detaliczny', 'ul. Sobieskiego, 3', 135792468),
('Oksana Szymańska', 'Handel detaliczny', 'ul. Mickiewicza, 4', 246813579),
('Wiktoria Nowakowska', 'Produkcja obuwia', 'ul. Leśna, 5', 908172635);
GO

-- Insert into 'services' table
INSERT INTO services (name, description) VALUES
('Akt notarialny potwierdzający umowę', 'Potwierdzanie umów i porozumień'),
('Prawo spadkowe', 'Świadczenie usług prawnych w sprawach spadkowych'),
('Pełnomocnictwa i upoważnienia', 'Załatwianie pełnomocnictw i upoważnień'),
('Darowizna majątku', 'Zawieranie umów darowizny'),
('Współwłasność i partnerstwo', 'Zawieranie umów i porozumień o współwłasność i partnerstwo');
GO

-- Insert into 'employees' table
INSERT INTO employees (name, job_title, phone_number, salary) VALUES
('Natalia Nowak', 'Notariusz', 123457890, 5000.00),
('Stanislaw Borek', 'Adwokat', 987654210, 4000.00),
('Maria Sidorowska', 'Prawnik', 135792460, 3000.00),
('Andrzej Kowalenko', 'Asystent notariusza', 246815790, 2000.00),
('Elena Marzynska', 'Asystent adwokata', 908172635, 2500.00);
GO

-- Insert into 'contracts' table
INSERT INTO contracts (client_id, service_id, employee_id, price, comment) VALUES
(3, 1, 5, 2000.00, 'PRIORYTET'),
(2, 2, 4, 1500.00, 'dom + samochód'),
(1, 3, 3, 1800.00, 'Podnieś cenę do 20000'),
(5, 4, 2, 2200.00, 'Popraw błąd w imieniu'),
(4, 5, 1, 1900.00, 'Igor Wojtowić');
GO

-- Insert into 'documents' table
INSERT INTO documents (contract_id, name, data, status) VALUES
(1, 'Pełnomocnictwo', '2023-05-31T12:00:00', 'Zrealizowane'),
(2, 'Testament', '2023-06-01T10:30:00', 'W trakcie'),
(3, 'Kupno-sprzedaż nieruchomości', '2023-05-30T15:45:00', 'Zrealizowane'),
(4, 'Podział spadku', '2023-06-02T09:15:00', 'W trakcie'),
(5, 'Pełnomocnictwo przedstawiciela', '2023-06-04T14:20:00', 'Nowy');
GO
