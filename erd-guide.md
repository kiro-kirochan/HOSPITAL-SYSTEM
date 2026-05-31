# ERD Guide — Hospitality Database

> This is a text-based ERD reference.
> Use this as your guide when drawing the actual diagram.

---

## Tables & Columns

### specialtb
| Column         | Type         | Constraint              |
|----------------|--------------|-------------------------|
| id             | INT(11)      | PK, AUTO_INCREMENT      |
| specialization | VARCHAR(100) | NOT NULL                |

---

### patreg
| Column     | Type                        | Constraint              |
|------------|-----------------------------|-------------------------|
| id         | INT(11)                     | PK, AUTO_INCREMENT      |
| fname      | VARCHAR(50)                 | NOT NULL                |
| lname      | VARCHAR(50)                 | NOT NULL                |
| email      | VARCHAR(100)                | NOT NULL                |
| password   | VARCHAR(255)                | NOT NULL                |
| contact    | VARCHAR(15)                 | NOT NULL                |
| gender     | ENUM(Male, Female, Other)   | NOT NULL, DEFAULT Other |
| created_at | DATETIME                    | NOT NULL, DEFAULT NOW() |

---

### doctb
| Column     | Type         | Constraint                          |
|------------|--------------|-------------------------------------|
| id         | INT(11)      | PK, AUTO_INCREMENT                  |
| name       | VARCHAR(100) | NOT NULL                            |
| email      | VARCHAR(100) | NOT NULL                            |
| password   | VARCHAR(255) | NOT NULL                            |
| spec_id    | INT(11)      | NOT NULL, FK → specialtb.id         |
| docFees    | DECIMAL(10,2)| NOT NULL, DEFAULT 0.00              |
| created_at | DATETIME     | NOT NULL, DEFAULT NOW()             |

---

### appointmenttb
| Column | Type                                     | Constraint                         |
|--------|------------------------------------------|------------------------------------|
| id     | INT(11)                                  | PK, AUTO_INCREMENT                 |
| pid    | INT(11)                                  | NOT NULL, FK → patreg.id           |
| did    | INT(11)                                  | NOT NULL, FK → doctb.id            |
| apdate | DATE                                     | NOT NULL                           |
| aptime | TIME                                     | NOT NULL                           |
| reason | TEXT                                     | DEFAULT NULL                       |
| status | ENUM(Pending, Confirmed, Completed, Cancelled) | NOT NULL, DEFAULT Pending  |

---

## Relationships

```
specialtb ──────────< doctb
  id (PK)              spec_id (FK)
  One specialty can have many doctors.
  ON DELETE RESTRICT — cannot delete a specialty that has doctors.

patreg ──────────────< appointmenttb
  id (PK)               pid (FK)
  One patient can have many appointments.
  ON DELETE CASCADE — deleting a patient removes their appointments.

doctb ───────────────< appointmenttb
  id (PK)               did (FK)
  One doctor can have many appointments.
  ON DELETE CASCADE — deleting a doctor removes their appointments.
```

---

## Cardinality Summary

| Parent       | Child          | Relationship | Rule                  |
|--------------|----------------|--------------|-----------------------|
| specialtb    | doctb          | 1 to many    | RESTRICT on delete    |
| patreg       | appointmenttb  | 1 to many    | CASCADE on delete     |
| doctb        | appointmenttb  | 1 to many    | CASCADE on delete     |

---

## 3NF Note

The original `doctb` stored `specialization VARCHAR(100)` as a plain text column.
This created a transitive dependency:

```
doctor.id  →  doctor.spec_id  →  specialtb.specialization
```

The specialization name was not directly dependent on the doctor's PK —
it depended on the specialty. Keeping it as text in `doctb` duplicated
data already owned by `specialtb`, breaking 3NF.

**Fix applied:** `specialization VARCHAR(100)` was replaced with `spec_id INT`
as a proper FOREIGN KEY to `specialtb(id)`. The name now lives in exactly
one place and `doctb` references it by ID.
