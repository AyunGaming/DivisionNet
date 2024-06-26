<?php

namespace division\Models;

class Kamenews {
	private int $id;

	private string $title;

	private string $date;

	private string $desc;

	/**
	 * @var array<Article>
	 */
	private array $articles = [];

	private User $writer;

	public function hydrate(array $data) {
		if (array_key_exists('id', $data)) {
			$this->id = $data['id'];
		}

		if (array_key_exists('titre', $data)) {
			$this->title = $data['titre'];
		}

		if (array_key_exists('date', $data)) {
			$this->date = $data['date'];
		}

		if (array_key_exists('description', $data)) {
			$this->desc = $data['description'];
		}

		if (array_key_exists('writer', $data)) {
			$this->writer = $data['writer'];
		}
	}

	public function addArticle(Article $article): void {
		$this->articles[] = $article;
	}

	public function getId(): int {
		return $this->id;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function getDate(): string {
		return $this->date;
	}

	public function getDesc(): string {
		return $this->desc;
	}

	public function getArticles(): array {
		return $this->articles;
	}

	public function getWriter(): User {
		return $this->writer;
	}
}