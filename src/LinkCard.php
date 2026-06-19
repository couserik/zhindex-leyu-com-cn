<?php
/**
 * LinkCard - renders an HTML link card with title, description, url and image.
 */

class LinkCard
{
    private string $title;
    private string $description;
    private string $url;
    private string $imageUrl;
    private string $keyword;

    public function __construct(
        string $title = '',
        string $description = '',
        string $url = '',
        string $imageUrl = '',
        string $keyword = ''
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->imageUrl = $imageUrl;
        $this->keyword = $keyword;
    }

    /**
     * Set the card title.
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set the card description.
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set the target URL.
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Set the image URL for the card.
     */
    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * Set a keyword tag to display on the card.
     */
    public function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;
        return $this;
    }

    /**
     * Render the link card as an HTML string.
     * All dynamic values are HTML-escaped before output.
     *
     * @return string The HTML markup.
     */
    public function render(): string
    {
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedImageUrl = htmlspecialchars($this->imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedKeyword = htmlspecialchars($this->keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $imageBlock = '';
        if ($escapedImageUrl !== '') {
            $imageBlock = sprintf(
                '<img class="link-card-image" src="%s" alt="%s" loading="lazy" />',
                $escapedImageUrl,
                $escapedTitle
            );
        }

        $keywordBadge = '';
        if ($escapedKeyword !== '') {
            $keywordBadge = sprintf(
                '<span class="link-card-keyword">%s</span>',
                $escapedKeyword
            );
        }

        $html = <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer" class="link-card-anchor">
        <div class="link-card-content">
            <div class="link-card-text">
                <h3 class="link-card-title">{$escapedTitle}</h3>
                <p class="link-card-description">{$escapedDescription}</p>
                {$keywordBadge}
            </div>
            {$imageBlock}
        </div>
    </a>
</div>
HTML;

        return $html;
    }

    /**
     * Create a LinkCard instance with sample data.
     *
     * @return self
     */
    public static function createSample(): self
    {
        $card = new self();
        $card->setTitle('乐鱼体育 - 精彩赛事在线')
            ->setDescription('乐鱼体育提供最新体育赛事直播、比分数据与专业分析，覆盖足球、篮球、网球等多项运动。')
            ->setUrl('https://zhindex-leyu.com.cn')
            ->setImageUrl('https://zhindex-leyu.com.cn/images/sports-banner.jpg')
            ->setKeyword('乐鱼体育');

        return $card;
    }
}

// -----------------------------------------------------------------------------
// Example usage (uncomment to test):
// -----------------------------------------------------------------------------
// $card = LinkCard::createSample();
// echo $card->render();