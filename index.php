<?php

// lucas.cardial@themembers.com.br
// david@themembers.com.br
// danilo@themembers.com.br

interface ReportGenerateServiceInterface
{
    public function generate($content);
}

class ReportXmlService implements ReportGenerateServiceInterface
{
    const FORMAT = 'xml';

    public function generate($content)
    {
        return join('::', [
            self::FORMAT,
            $content
        ]);
    }
}

class ReportPdfService implements ReportGenerateServiceInterface
{
    const FORMAT = 'pdf';

    public function generate($content)
    {
        return join('::', [
            self::FORMAT,
            $content
        ]);
    }
}

class ReportXlsxService implements ReportGenerateServiceInterface
{
    const FORMAT = 'xlsx';

    public function generate($content)
    {
        return join('::', [
            self::FORMAT,
            $content
        ]);
    }

}

class ReportServiceInject {

    const FORMATS  = [
        ReportXmlService::FORMAT    => ReportXmlService::class,
        ReportPdfService::FORMAT    => ReportPdfService::class,
        ReportXlsxService::FORMAT   => ReportXlsxService::class
    ];

    public function inject(string $format) : ReportGenerateServiceInterface
    {
        if(in_array($format, array_keys(self::FORMATS)))
        {
            throw new Error('Invalid mime type.');
        }

        return new (self::FORMATS[$format])();
    }
}

class Report {

    private function getService(string $format)
    {
        return (new ReportServiceInject)
            ->inject($format);
    }

    public function generate(string $title, string $content, string $format) {

        $this->getService($format)->generate($content);

        if ($format === 'xml') {
            # gerar o documento em formato XML
        } else if ($format === 'pdf'){
            # gerar o documento em formato PDF
        }

        #outros formatos 
    }
}
