<?php

namespace Controllers\Administrator;

use \Controllers\BaseController;
use \Models\Administrator\MagazineModel;
use \Exception;

/**
 * Controller for managing magazine operations within the administrative interface.
 */
class MagazineController extends BaseController
{
    /**
     * @var MagazineModel The model handling magazine data interactions
     */
    protected $magazineModel;

    /**
     * Constructs the MagazineController, initializes base controller and magazine model.
     */
    public function __construct()
    {
        parent::__construct();
        $this->magazineModel = new MagazineModel();
    }

    /**
     * Display the index page for magazine management.
     * Fetches all magazines and passes them to the view.
     */
    public function index()
    {
        $magazines = $this->magazineModel->getAllMagazines();
        $this->renderAdm(true, 'Magazine Management', 'magazine', ['magazines' => $magazines]);
    }

    /**
     * Fetch all magazines and return them in a format suitable for DataTables.
     */
    public function viewAll()
    {
        $magazines = $this->magazineModel->getAllMagazines();
        if ($magazines) {
            // Retorne os dados no formato JSON
            echo json_encode([
                "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 0,
                "recordsTotal" => count($magazines),
                "recordsFiltered" => count($magazines),
                "data" => $magazines
            ]);
        } else {
            // Retorne um JSON vazio ou uma estrutura padrão
            echo json_encode([]);
        }
    }

    /**
     * Fetch a single magazine by its ID and return its data as JSON.
     *
     * @param int $id The ID of the magazine to retrieve.
     */
    public function viewOne($id)
    {
        $magazine = $this->magazineModel->getMagazineById($id);
        echo json_encode($magazine);
    }

    /**
     * Inserts a new magazine using data from the POST request.
     * Processes file uploads and adds magazine data to the database.
     */
    public function insert()
    {
        try {
            // Define todas as revistas anteriores como não atuais
            $this->magazineModel->setAllMagazinesToNotCurrent();

            // Verifica se a imagem da capa foi enviada
            if (!isset($_FILES['cover_image']) || $_FILES['cover_image']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Cover image file is required.");
            }

            $nextEdition = $this->magazineModel->getNextEditionNumber();
            $coverFileName = "ed_{$nextEdition}.jpg";
            $pdfFileName = "ed_{$nextEdition}.pdf";

            $coverDestination = __DIR__ . "/../../assets/images/magazine-covers/" . $coverFileName;
            $pdfDestination = __DIR__ . "/../../assets/images/magazine-issues/" . $pdfFileName;

            // Move os arquivos para os diretórios de destino
            if (
                !move_uploaded_file($_FILES['cover_image']['tmp_name'], $coverDestination) ||
                !move_uploaded_file($_FILES['pdf_file']['tmp_name'], $pdfDestination)
            ) {
                throw new Exception("Failed to upload files.");
            }

            $data = [
                'hid' => bin2hex(random_bytes(16)),
                'number' => $nextEdition,
                'publication_date' => $_POST['publication_date'],
                'cover' => $coverFileName,
                'mag' => $pdfFileName,
                'atual' => 'T' // Define esta nova revista como atual
            ];

            $result = $this->magazineModel->insertMagazine($data);
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Updates an existing magazine with new data provided via POST request.
     *
     * @param int $id The ID of the magazine to update.
     */
    public function update($id)
    {
        if (empty($id)) {
            echo json_encode(['status' => 'error', 'message' => 'No magazine ID provided.']);
            return;
        }

        try {
            $data = $_POST;
            $data['cover_image'] = $_FILES['cover_image'] ?? null;
            $data['pdf_file'] = $_FILES['pdf_file'] ?? null;

            // Verifique se ambos os arquivos foram enviados e são válidos
            if (
                isset($data['cover_image']) && isset($data['pdf_file']) &&
                $data['cover_image']['error'] === UPLOAD_ERR_OK &&
                $data['pdf_file']['error'] === UPLOAD_ERR_OK
            ) {

                // Chame um método do Model para obter o último ID ou número da edição
                $lastId = $this->magazineModel->getLastId(); // Implemente este método no Model

                // Calcule o novo número da edição
                // $newId = $lastId + 1;
                $newId = $lastId;

                // Crie os novos nomes para os arquivos
                $newCoverName = "ed_{$newId}.jpg";
                $newPdfName = "ed_{$newId}.pdf";

                // Defina os caminhos de destino para os uploads
                $coverPath = __DIR__ . "/../../assets/images/magazine-covers/{$newCoverName}";
                $pdfPath = __DIR__ . "/../../assets/images/magazine-issues/{$newPdfName}";

                // Mova os arquivos para o novo destino com os novos nomes
                move_uploaded_file($data['cover_image']['tmp_name'], $coverPath);
                move_uploaded_file($data['pdf_file']['tmp_name'], $pdfPath);

                // Prepare os dados para atualizar no banco
                $data['cover_image']['name'] = $newCoverName;
                $data['pdf_file']['name'] = $newPdfName;

                // Atualize a revista no banco de dados
                $updateResult = $this->magazineModel->updateMagazine($id, $data);
                if ($updateResult) {
                    echo json_encode(['status' => 'success', 'message' => 'Magazine updated successfully.']);
                } else {
                    throw new Exception("Failed to update magazine.");
                }
            } else {
                throw new Exception("Both cover image and PDF file are required.");
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Deletes a magazine by its ID.
     *
     * @param int $id The ID of the magazine to delete.
     */
    public function delete()
    {

        $id = $_POST['id'];

        $result = $this->magazineModel->deleteMagazine($id);
        echo json_encode(['success' => $result, 'message' => $result ? 'Magazine deleted successfully.' : 'Failed to delete magazine.']);
    }

    /**
     * Handles the upload of the magazine cover and PDF files.
     *
     * @param array $coverImage The uploaded cover image file.
     * @param array $pdfFile The uploaded PDF file.
     * @return array Response with status and message.
     */
    private function uploadMagazine($coverImage, $pdfFile)
    {
        $nextEdition = $this->magazineModel->getNextEditionNumber();

        $coverFileName = "ed_{$nextEdition}.jpg";
        $pdfFileName = "ed_{$nextEdition}.pdf";

        $coverDestination = __DIR__ . "/../../assets/images/magazine-covers/" . $coverFileName;
        $pdfDestination = __DIR__ . "/../../assets/images/magazine-issues/" . $pdfFileName;

        if (!move_uploaded_file($coverImage['tmp_name'], $coverDestination) || !move_uploaded_file($pdfFile['tmp_name'], $pdfDestination)) {
            return ['status' => 'error', 'message' => 'Failed to upload files.'];
        }

        return [
            'status' => 'success',
            'message' => 'Files uploaded successfully.',
            'coverPath' => $coverFileName,
            'pdfPath' => $pdfFileName
        ];
    }

    /**
     * Prepare Img name
     *
     * @param [type] $coverImg
     * @return void
     */
    private function prepareCoverName($coverImg)
    {
        // $_FILES['cover_image']
        $coverParts = explode("-", $coverImg['name']);

        return 'ed_' . $coverParts[1];
    }

    /**
     * * Prepare issue name
     *
     * @param [type] $issuePDF
     * @return void
     */
    private function prepareIssueName($issuePDF)
    {
        $issueParts = explode("-", $issuePDF['name']);

        return 'ed_' . $issueParts[1];
    }
}
