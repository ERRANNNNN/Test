<?php

class XMLHttpService
{
    public function request($url, $method, $options = [])
    {
        $token = "";
        if (!empty($options)) {
            $token = $options['token'];
        }
        echo "Запрос на " . $url . " методом " . $method . (empty($token) ?: ", токен: " . $token) . "\n";
    }
}

class Http
{
    private $service;

    public function __construct(XMLHttpService $xmlHttpService)
    {
        $this->service = $xmlHttpService;
    }

    public function get(string $url, array $options)
    {
        $this->service->request($url, 'GET', $options);
    }

    public function post(string $url)
    {
        $this->service->request($url, 'POST');
    }
}

class UserDataService
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getUserData()
    {
        $http = new Http(new XMLHttpService());
        $options = [
            'token' => $this->repository->getSecretKey()
        ];
        $http->get('https://google.com', $options);
    }
}

abstract class Repository
{
    abstract public function getSecretKey(): string;
}

class DBRepository extends Repository {
    public function getSecretKey(): string
    {
        return "DBToken";
    }
}

class FileRepository extends Repository {
    public function getSecretKey(): string
    {
        return "FileToken";
    }
}

$repository = new DBRepository();
$userDataService = new UserDataService($repository);
$userDataService->getUserData();
$repository = new FileRepository();
$userDataService = new UserDataService($repository);
$userDataService->getUserData();
