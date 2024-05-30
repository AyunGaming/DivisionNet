<?php

namespace division\HTTP\Routing;

use division\Data\DAO\guild\GuildDAO;
use division\Data\Database;
use division\Models\Managers\GuildManager;
use division\Models\User;
use division\Utils\Flashes;
use division\Utils\FlashMessage;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GuildController extends AbstractController{
	private GuildManager $guildManager;

	public function __construct(Database $database){
		parent::__construct($database);
		$this->guildManager = new GuildManager(new GuildDAO($this->database));
	}

	public function create(Response $response, Request $request): Response{
		$post = $request->getParsedBody();

		$parser = RouteContext::fromRequest($request)->getRouteParser();
		$res = $response->withStatus(StatusCodeInterface::STATUS_FOUND)->withHeader('Location', $parser->urlFor('home')); //TODO: Replace by "manage-guild"

		$post['owner'] = $request->getAttribute(User::class);

		try {
			$this->guildManager->create($post);
			Flashes::add(FlashMessage::success("La guilde {$post['name']} a été créé !"));
		} catch (\RuntimeException $e) {
			$res = $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR)->withHeader('Location', $parser->urlFor('guild-creation'));
			Flashes::add(FlashMessage::danger($e->getMessage()));
		}

		return $res;
	}

	public function viewManageGuild(Request $request, Response $response, Twig $twig): Response{
		$user = $request->getAttribute(User::class);
		$guild = $this->guildManager->getByOwner($user);

		if($guild == null){
			$parser = RouteContext::fromRequest($request)->getRouteParser();
			return $response->withStatus(StatusCodeInterface::STATUS_FOUND)->withHeader('Location', $parser->urlFor('create-guild'));
		}

		return $twig->render($response, 'guildAdminPanel.twig', [
			'user' => $user,
			'guild' => $guild,
			'flashes' => Flashes::all()
		]);
	}

	/**
	 * @throws SyntaxError
	 * @throws RuntimeError
	 * @throws LoaderError
	 */
	public function viewCreateGuild(Request $request, Response $response, Twig $twig): Response {
		$user = $request->getAttribute(User::class);

		return $twig->render($response, 'guildCreation.twig', [
			'user' => $user,
			'flashes' => Flashes::all()
		]);
	}
}
