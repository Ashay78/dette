UPDATE "ruser_debt" SET amount = amount + month_subscription FROM "debt" WHERE "debt".id = "ruser_debt".debt_id AND extract(day from current_date) = extract(day from date) AND is_subscription=true;
