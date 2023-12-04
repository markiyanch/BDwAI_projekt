-- Use the desired database
USE kancelaria_notarialna;
GO

-- Declare variables
DECLARE @tableName NVARCHAR(128);
DECLARE @sqlQuery NVARCHAR(MAX);

-- Create a cursor to loop through tables
DECLARE tableCursor CURSOR FOR
SELECT table_name = t.name
FROM sys.tables t
INNER JOIN sys.schemas s ON t.schema_id = s.schema_id
ORDER BY s.name, t.name;

-- Open the cursor
OPEN tableCursor;

-- Fetch the first table name
FETCH NEXT FROM tableCursor INTO @tableName;

-- Loop through tables
WHILE @@FETCH_STATUS = 0
BEGIN
    -- Build and execute the dynamic SQL query
    SET @sqlQuery = 'SELECT * FROM ' + QUOTENAME(@tableName);
    EXEC sp_executesql @sqlQuery;

    -- Fetch the next table name
    FETCH NEXT FROM tableCursor INTO @tableName;
END

-- Close and deallocate the cursor
CLOSE tableCursor;
DEALLOCATE tableCursor;
