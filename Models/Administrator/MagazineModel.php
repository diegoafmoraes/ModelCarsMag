<?php

namespace Models\Administrator;

use \Models\BaseModel;
use \Exception;

class MagazineModel extends BaseModel
{

    /**
     * Retrieves all magazines.
     *
     * @return array|null An array of magazines or null if none found.
     */
    public function getAllMagazines()
    {
        $sql = "SELECT * FROM mags WHERE deleted_at IS NULL";
        $stmt = $this->db->query($sql);

        if ($stmt && $stmt->rowCount() > 0) {
            return parent::fetchAll($stmt);
        }

        return null;
    }

    /**
     * Retrieves a single magazine by its ID.
     *
     * @param int $id The ID of the magazine.
     * @return object|null The magazine data or null if not found.
     */
    public function getMagazineById($id)
    {
        $sql = "SELECT * FROM mags WHERE id = :id AND deleted_at IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return parent::fetch($stmt);
        }

        return null;
    }

    /**
     * Retrieves the last inserted magazine.
     *
     * @return object|null The last magazine entry or null if none found.
     */
    public function getLastMagazine()
    {
        $sql = "SELECT * FROM mags ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->query($sql);

        if ($stmt && $stmt->rowCount() > 0) {
            return parent::fetch($stmt);
        }

        return null;
    }

    /**
     * Inserts a new magazine entry.
     *
     * @param array $data Associative array containing all the required fields.
     * @return array Status of the operation with a message.
     */
    public function insertMagazine($data)
    {
        $sql = "INSERT INTO mags (hid, number, publication_date, cover, mag, atual, created_at) VALUES (:hid, :number, :publication_date, :cover, :mag, :atual, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':hid' => $data['hid'],
            ':number' => $data['number'],
            ':publication_date' => $data['publication_date'],
            ':cover' => $data['cover'],
            ':mag' => $data['mag'],
            ':atual' => $data['atual']
        ]);

        if ($stmt->rowCount() > 0) {
            return ['status' => 'success', 'message' => 'Magazine added successfully.'];
        } else {
            return ['status' => 'error', 'message' => 'Failed to add magazine.'];
        }
    }



    /**
     * Updates an existing magazine entry.
     *
     * @param int $id The ID of the magazine to update.
     * @param string $coverFileName The name of the cover image file.
     * @param string $pdfFileName The name of the PDF file.
     * @return bool True on success, false on failure.
     */
    public function updateMagazine($id, $data)
    {
        $sql = "UPDATE mags SET cover = :cover, mag = :mag, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);

        // Verifique se os dados são válidos antes de acessar os índices
        if (isset($data['cover_image']['name'])) {
            $stmt->bindParam(':cover', $data['cover_image']['name']);
        } else {
            throw new Exception("Cover image name is missing.");
        }

        if (isset($data['pdf_file']['name'])) {
            $stmt->bindParam(':mag', $data['pdf_file']['name']);
        } else {
            throw new Exception("PDF file name is missing.");
        }

        return $stmt->execute();
    }

    /**
     * Helps to rename files and bd col. data
     *
     * @return void
     */
    public function getLastId()
    {
        $sql = "SELECT id FROM mags ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn(); // Retorna o último ID
    }

    /**
     * Deletes a magazine entry by soft delete.
     *
     * @param int $id The ID of the magazine to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteMagazine($id)
    {
        $sql = "UPDATE mags SET deleted_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    /**
     * Turn False before new Insertion
     *
     * @return void
     */
    public function setAllMagazinesToNotCurrent()
    {
        $sql = "UPDATE mags SET atual = 'F' WHERE atual = 'T'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    /**
     * Next Edition
     *
     * @return void
     */
    public function getNextEditionNumber()
    {
        $sql = "SELECT MAX(number) as max_number FROM mags";
        $stmt = $this->db->query($sql);
        if ($stmt->rowCount() > 0) {
            $row = parent::fetch($stmt);
            return $row->max_number + 1;
        }
        return 1; // If no magazines exist, start with 1
    }
}
