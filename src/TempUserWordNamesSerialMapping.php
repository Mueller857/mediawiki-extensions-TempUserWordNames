<?php

namespace MediaWiki\Extension\TempUserWordNames;

use InvalidArgumentException;
use MediaWiki\Config\Config;
use MediaWiki\User\TempUser\SerialMapping;

class TempUserWordNamesSerialMapping implements SerialMapping {
	private int $offset;

	private int $numWords;

	private array $words = [];

	private bool $useIndex;

	public function __construct( array $config, Config $mainConfig ) {
		$this->offset = $config['offset'] ?? 0;
		$this->numWords = $mainConfig->get( 'TempUserWordNamesLength' );
		$this->words = $mainConfig->get( 'TempUserWordNamesList' );
		$this->useIndex = $mainConfig->get( 'TempUserWordNamesUseIndex' );
	}

	public function getSerialIdForIndex( int $index ): string {
		if ( empty( $this->words ) || $this->numWords <= 0 || $this->numWords > count( $this->words ) ) {
			throw new InvalidArgumentException(
				'The word list is empty, or the number of words is less than 1 or the length of the word list.' );
		}

		$selected = array_map( function ( $k ) {
			return ucfirst( $this->words[$k] );
		}, array_rand( $this->words, $this->numWords ) );
		shuffle( $selected );
		return implode( '', $selected ) . ( $this->useIndex ? $index + $this->offset : '' );
	}
}
